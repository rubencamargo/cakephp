<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Text;
use Cake\Datasource\ConnectionManager;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['home', 'blog', 'detail']);
    }
    
    public function home()
    {
        $this->Authorization->skipAuthorization();
        
        /*
        $conditions = ['Published' => 1];
        
        $this->paginate = [
            'contain' => ['Users', 'Tags'],
            'conditions' => $conditions,
            'order' => ['Articles.id' => 'DESC'],
            'limit' => 3
        ];
        
        $articles = $this->paginate($this->Articles);
        */
        
        $articles = $this->Articles->find('all')
        ->contain(['Users', 'Tags'])
        ->where(['Published' => 1, 'type_id' => 1])
        ->order(['Articles.id' => 'DESC'])
        ->limit(3);

        $portfolios = $this->Articles->find('all')
        ->contain(['Users', 'Tags'])
        ->where(['Published' => 1, 'type_id' => 2])
        //->order(['Articles.id' => 'DESC'])
        ->limit(6);
        
        $technologies = $this->Articles->find('all')
        ->contain(['Users', 'Tags'])
        ->where(['Published' => 1, 'type_id' => 3])
        //->order(['Articles.id' => 'DESC'])
        ->limit(6);
        
        $this->set(compact('articles'));
        $this->set(compact('portfolios'));
        $this->set(compact('technologies'));
    }
    
    public function blog()
    {
        $this->Authorization->skipAuthorization();
        
        $conditions = ['Published' => 1, 'type_id' => 1];
        if ($this->request->getQuery('search') != '') {
            $search = $this->request->getQuery('search');
            $conditions = ['Articles.title like ' => '%' . $search . '%'];
        }
        
        $this->paginate = [
            'contain' => ['Users', 'Tags'],
            'conditions' => $conditions,
            'order' => ['Articles.id' => 'DESC']
        ];
        
        $articles = $this->paginate($this->Articles);
        
        $this->set(compact('articles'));
    }
    
    public function detail($slug = null)
    {
        $this->Authorization->skipAuthorization();
        
        $article = $this->Articles->find('all', [
            'contain' => [
                'Users', 
                'Tags', 
                'Comments.Users' => function (\Cake\ORM\Query $query) {
                    return $query->where(['Comments.active' => 1]);
                }
            ],
            'conditions' => ['slug' => $slug]
        ])
        ->first();
        
        $this->set(compact('article'));
    }
    
    public function addComment()
    {
        $this->viewBuilder()->setLayout(null);
        $this->loadModel('Comments');
        $comment = $this->Comments->newEmptyEntity();
        
        //$this->Authorization->authorize($article);
        if (!$this->Authorization->can($comment, 'add')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect($this->referer());
        }
        
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $article = $this->Articles->newEmptyEntity();
        
        //$this->Authorization->authorize($article);
        if (!$this->Authorization->can($article, 'index')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        $conditions = [];
        if ($this->request->getQuery('search') != '') {
            $search = $this->request->getQuery('search');
            $conditions = ['Articles.title like ' => '%' . $search . '%'];
        }
        
        $this->paginate = [
            'contain' => ['Users', 'Tags', 'Types'],
            'conditions' => $conditions,
            'order' => ['Articles.id' => 'DESC']
        ];
        
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Users', 'Tags', 'Types'],
        ]);

        //$this->Authorization->authorize($article);
        if (!$this->Authorization->can($article, 'view')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        $this->set(compact('article'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        
        //$this->Authorization->authorize($article);
        if (!$this->Authorization->can($article, 'add')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            
            // Changed: Set the user_id from the current user.
            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();
            
            $article->slug = strtolower(Text::slug($article->title));
            
            $article->image_name = null;
            $article->image_type = null;
            $article->image_size = null;
            
            if ((!$article->getErrors()) && ($this->request->getData('image')->getClientFilename() != '')) {
                // Save and upload image
                $image = $this->request->getData('image');
                
                $article->image_name = time() . '-' . $image->getClientFilename();
                $article->image_type = $image->getClientMediaType();
                $article->image_size = $image->getSize();
                
                $targetPath = WWW_ROOT . 'img' . DS . 'articles' . DS . $article->image_name;
                
                if ($article->image_name) {
                    $image->moveTo($targetPath);
                }
            }
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        
        $users = $this->Articles->Users->find('list', [
            'limit' => 200,
            'keyField' => 'id',
            'valueField' => function ($article) {
                return $article->get('label');
            }
        ]);
        
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $types = $this->Articles->Types->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users', 'tags', 'types'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags'],
        ]);
        
        //$this->Authorization->authorize($article);
        if (!$this->Authorization->can($article, 'edit')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            
            if ($article['slug'] == "") {
                $article['slug'] = strtolower(Text::slug($article['title']));
            }
            
            if ((!$article->getErrors()) && ($this->request->getData('image')->getClientFilename() != '')) {
                // Save and upload image
                $image = $this->request->getData('image');
                
                $article->image_name = $article->id . '-' . $image->getClientFilename();
                $article->image_type = $image->getClientMediaType();
                $article->image_size = $image->getSize();
                
                $targetPath = WWW_ROOT . 'img' . DS . 'articles' . DS . $article->image_name;
                
                if ($article->image_name) {
                    $image->moveTo($targetPath);
                }
            }
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'view', $article->id]);
            }
            
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $types = $this->Articles->Types->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users', 'tags', 'types'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        
        //$this->Authorization->authorize($article);
        if (!$this->Authorization->can($article, 'delete')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Articles', 'action' => 'blog']);
        }
        
        $targetPath = WWW_ROOT . 'img' . DS . 'articles' . DS . $article->image_name;
        
        if ($this->Articles->delete($article)) {
            if (file_exists($targetPath)) {
                unlink($targetPath);
            }
            
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function changeStatus($id = null, $status = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('Users');
        $user = $this->Users->get($this->request->getAttribute('identity')->getIdentifier());
        $article = $this->Articles->get($id);
        
        //$this->Authorization->authorize($user);
        if (!$this->Authorization->can($user, 'delete')) {
            $this->Flash->error(__('Restricted access.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
        
        $article->published = !$status;
        
        if ($this->Articles->save($article)) {
            $this->Flash->success(__('The article has been saved.'));
        } else {
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        
        return $this->redirect($this->referer());
    }
}
