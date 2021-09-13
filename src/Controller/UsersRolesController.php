<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UsersRoles Controller
 *
 * @property \App\Model\Table\UsersRolesTable $UsersRoles
 * @method \App\Model\Entity\UsersRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersRolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $usersRoles = $this->paginate($this->UsersRoles);

        $this->set(compact('usersRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersRole = $this->UsersRoles->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('usersRole'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersRole = $this->UsersRoles->newEmptyEntity();
        if ($this->request->is('post')) {
            $usersRole = $this->UsersRoles->patchEntity($usersRole, $this->request->getData());
            if ($this->UsersRoles->save($usersRole)) {
                $this->Flash->success(__('The users role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users role could not be saved. Please, try again.'));
        }
        $this->set(compact('usersRole'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersRole = $this->UsersRoles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersRole = $this->UsersRoles->patchEntity($usersRole, $this->request->getData());
            if ($this->UsersRoles->save($usersRole)) {
                $this->Flash->success(__('The users role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users role could not be saved. Please, try again.'));
        }
        $this->set(compact('usersRole'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersRole = $this->UsersRoles->get($id);
        if ($this->UsersRoles->delete($usersRole)) {
            $this->Flash->success(__('The users role has been deleted.'));
        } else {
            $this->Flash->error(__('The users role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
