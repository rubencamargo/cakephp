<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\I18n\I18n;
use Cake\I18n\MessagesFileLoader;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        // Check authentication result and lock your site
        $this->loadComponent('Authentication.Authentication');

        $this->loadComponent('Authorization.Authorization');
        
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the action to not require authentication
        $this->Authentication->addUnauthenticatedActions(['changeLanguage']);
        
        if ($this->request->getSession()->check('Config.language')) {
            I18n::setLocale($this->request->getSession()->read('Config.language'));
        } else {
            $this->request->getSession()->write('Config.language', I18n::getLocale());
        }
        
        $this->loadModel('Articles');
        $haveArticles = $this->Articles->find('all')->where(['published' => 1])->first();
        $this->set(compact('haveArticles'));
    }
    
    public function changeLanguage($language = null)
    {
        $this->Authorization->skipAuthorization();
        
        $languages = ['en_US', 'es_ES'];
        
        if (($language != null) && (in_array($language, $languages))) {
            $this->request->getSession()->write('Config.language', $language);
            return $this->redirect($this->referer());
        } else {
            $this->request->getSession()->write('Config.language', I18n::getLocale());
            return $this->redirect($this->referer());
        }
    }
}
