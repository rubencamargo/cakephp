<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;
use Cake\Mailer\Mailer;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }
    
    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        if (($result->getData()) && (!$result->getData()->active)) {
            $this->Flash->error(__('User inactive'));
            $this->Authentication->logout();
        }
        
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $user = $this->Users->get($result->getData()->id);
            $user->last_login = time();
            $this->Users->save($user);
            
            $this->request->getSession()->write('Config.language', $user->language);
            
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Articles',
                'action' => 'blog',
            ]);
            
            return $this->redirect($redirect);
        }
        
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }
    
    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('Logout success.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $user = $this->Users->get($this->request->getSession()->read('Auth.id'));
        
        //$this->Authorization->authorize($user);
        if (!$this->Authorization->can($user, 'index')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        $conditions = [];
        if ($this->request->getQuery('search') != '') {
            $search = $this->request->getQuery('search');
            $conditions = [
                'OR' => [
                    'Users.name like ' => '%' . $search . '%',
                    'Users.lastname like ' => '%' . $search . '%',
                    'Users.email like ' => '%' . $search . '%'
                ]
            ];
        }
        
        $this->paginate = [
            'contain' => ['Roles'],
            'conditions' => $conditions
        ];
        
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Articles'],
        ]);
        
        //$this->Authorization->authorize($user);
        if (!$this->Authorization->can($user, 'view')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            $user->ip = $this->request->clientIp();
            
            if ($user->ip == '127.0.0.1') { // Localhost
                $user->ip = '181.46.165.130';
            }
            
            $user->name = ucwords($user->name);
            $user->lastname = ucwords($user->lastname);
            
            // Geoip
            $http = new Client();
            
            $response = null;
            $response_json = [];
            
            try {
                //$response = $http->get('http://api.ipapi.com/134.201.250.155?access_key=d12feaf54bcf5b9edf3ad592cba4c205&format=1');
                $response = $http->get('http://api.ipapi.com/' . $user->ip . '?access_key=d12feaf54bcf5b9edf3ad592cba4c205&format=1');
                if ($response) {
                    $response_json = $response->getJson();
                }
            } catch (Exception $exception) {
                
            }
            
            if (isset($response_json['ip'])) {
                $user->country_flag = $response_json['location']['country_flag'];
                $user->country_code = $response_json['country_code'];
                $user->country_name = $response_json['country_name'];
                $user->region_name = $response_json['region_name'];
                $user->city = $response_json['city'];
                $user->latitude = $response_json['latitude'];
                $user->longitude = $response_json['longitude'];
            }
            
            if ($this->Users->save($user)) {
                if (!Configure::read('debug')) {
                    $mailer = new Mailer();
                    $mailer->setEmailFormat('html');
                    $mailer->setFrom('info@rubencamargo.com.ar', 'RUBENCAMARGO.COM.AR');
                    $mailer->setTo('info@rubencamargo.com.ar', 'Ruben Camargo');
                    $mailer->setSubject('Usuario registrado.');
    
                    $mailer->deliver(
                        '<br>Se ha registrado <b>' . $user->name . ' ' . $user->lastname . '</b>.' . 
                        '<br>Desde <b>' . $user->country_name . '</b>.' . 
                        '<br>Email <b>' . $user->email . '</b>.'
                    );
                }
                
                $this->Flash->success(__('The user has been registered. Please login now here.'));
                return $this->redirect(['action' => 'login']);
            }
            
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        
        //$this->Authorization->authorize($user);
        if (!$this->Authorization->can($user, 'edit')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        //$this->Authorization->authorize($user);
        if (!$this->Authorization->can($user, 'delete')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function changeStatus($id = null, $status = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        //$this->Authorization->authorize($user);
        if (!$this->Authorization->can($user, 'delete')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
        
        $user->active = !$status;
        
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been saved.'));
        } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        return $this->redirect($this->referer());
    }
}
