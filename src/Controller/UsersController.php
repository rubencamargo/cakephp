<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;

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
        
        // Geoip
        /*
        $http = new Client();
        //$response = $http->get('http://api.ipstack.com/181.46.165.130?access_key=ecbce6011232d8a6d3de6b08d27bff48&output=json');
        $response = $http->get(
            'http://api.ipstack.com/181.46.165.130',
            ['q' => 'test', '_content' => json_encode($data)],
            ['type' => 'json']
        );
        debug($response);*/
        
        if (($result->getData()) && (!$result->getData()->active)) {
            $this->Flash->error(__('User inactive'));
            $this->Authentication->logout();
        }
        
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
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
            'conditions' => $conditions,
            'limit' => 4
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
        
        $sum = $this->request->getData('var1') + $this->request->getData('var2');
        if ($sum != $this->request->getData('captcha_local')) {
            $this->Flash->error(__('The sum is not correct. Please, try again.'));
            return $this->redirect($this->referer());
            die();
        }
        //debug($this->request->getData()); die();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            $user->ip = $this->request->clientIp();
            
            if ($this->Users->save($user)) {
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
