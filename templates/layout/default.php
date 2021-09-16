<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
        </div>
        
        <div class="top-nav-links">
        	<?php if ($this->request->getSession()->check('Auth')) { ?>
        		<a href="<?= $this->Url->build('/') ?>users/edit/<?= $this->request->getSession()->read('Auth.id') ?>"><?= $this->request->getSession()->read('Auth.name') . ' ' . $this->request->getSession()->read('Auth.lastname') ?></a>
        		
            	<?php if ($this->request->getSession()->read('Auth.role_id') == 1) { ?>
                    <a href="<?= $this->Url->build('/') ?>articles">Articles</a>
                    <a href="<?= $this->Url->build('/') ?>tags">Tags</a>
                    <a href="<?= $this->Url->build('/') ?>users">Users</a>
                    <a href="<?= $this->Url->build('/') ?>roles">Roles</a>
                <?php } ?>
                <a href="<?= $this->Url->build('/') ?>users/logout">Logout</a>
                <?php } else { ?>
                <a href="<?= $this->Url->build('/') ?>users/login">Login</a>
            
            <?php } ?>
        </div>
    </nav>
    
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    
    <footer>
    	
    </footer>
</body>
</html>
