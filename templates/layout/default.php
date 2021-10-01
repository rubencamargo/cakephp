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

$cakeDescription = 'RubenCAMARGO';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website developed with CakePHP Framework.">
    <meta name="keywords" content="Ruben Camargo, HTML, CSS, JavaScript, PHP, CakePHP, Font Awesome">
    <meta name="author" content="Ruben Camargo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>
        <?= $cakeDescription ?>
        <?php //echo $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'style.css', 'fontawesome/all.min.css']) ?>
	<?= $this->Html->script(['jquery-3.6.0.min.js', 'app.js', 'fontawesome/all.min.js'], ['block' => 'js']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Ruben</span>CAMARGO</a>
        </div>
        
        <div class="top-nav-links">
        	<a href="<?= $this->Url->build('/') ?>blog">Blog</a>
        	<?php if ($this->request->getSession()->check('Auth')) { ?>
        		<?php if ($this->request->getSession()->read('Auth.role_id') == 1) { ?>
                    <a href="<?= $this->Url->build('/') ?>articles">Articles</a>
                    <a href="<?= $this->Url->build('/') ?>tags">Tags</a>
                    <a href="<?= $this->Url->build('/') ?>users">Users</a>
                    <a href="<?= $this->Url->build('/') ?>roles">Roles</a>
                <?php } ?>
                <a href="<?= $this->Url->build('/') ?>profile/<?= $this->request->getSession()->read('Auth.id') ?>">
                	<?= $this->request->getSession()->read('Auth.name') . ' ' . $this->request->getSession()->read('Auth.lastname') ?>
                </a>
        		<a href="<?= $this->Url->build('/') ?>logout">Logout</a>
                <?php } else { ?>
                <a href="<?= $this->Url->build('/') ?>login">Login</a>
            <?php } ?>
            
            <?php
        	if ($this->request->getSession()->read('Config.language') == 'en_US') {
        	    echo $this->Html->image("flags/united-states.png",
        	    [
        	        "alt" => "English",
        	        'url' => '/changeLanguage/es_ES',
        	        'title' => __('English'),
        	        'class' => 'flag-icon'
        	    ]);
        	}
        	
        	if ($this->request->getSession()->read('Config.language') == 'es_ES') {
        	    echo $this->Html->image("flags/spain.png",
        	    [
        	        "alt" => "Español",
        	        'url' => '/changeLanguage/en_US',
        	        'title' => __('Spanish'),
        	        'class' => 'flag-icon'
        	    ]);
        	}
        	?>
        </div>
    </nav>
    
    <?php if ($this->request->getParam('action') == 'home') { ?>
    <!--
    <div class="image-header">
    	<div class="text-header">
    		Programador
    	</div>
    </div>
    -->
    
    <!-- Parallax -->
    <div class="parallax">
    	<h1 class="text-parallax">Programador Web</h1>
    </div>
    <?php } ?>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    
    <br />
    
    <footer>
        <div class="container">
        	<div class="row">
        		<div class="column-responsive column-6">
        			&copy; Copyright 2020 - Rubén Camargo.
        		</div>
        		
        		<div class="column-responsive column-6">
        			<?php
            			echo $this->Html->link(
                        '<i class="fab fa-linkedin footer-icon"></i>',
                        'https://ar.linkedin.com/in/rubencamargo',
                        ['escape' => false, 'target' => '_blank']
                        );
        			?>
        			<?php
            			echo $this->Html->link(
                        '<i class="fab fa-github footer-icon"></i>',
                        'https://github.com/rubencamargo',
                        ['escape' => false, 'target' => '_blank']
                        );
        			?>
        		</div>
        	</div>
    	</div>
    </footer>
    
    <?= $this->fetch('js') ?>
</body>
</html>
