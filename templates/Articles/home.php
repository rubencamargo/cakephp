<?php if ($articles->count()) { ?>
<div class="articles index content">
    <h3><i class="fas fa-newspaper"></i> <?= __('Articles') ?></h3>
</div>

<br />
<?php } ?>

<?php
$columns = 3;
$porcentByPost = floor(100 / $columns);
$i = 1;
?>

<div class="row">
    <?php foreach ($articles as $article): ?>
        <?php if ($i > $columns) {echo '</div><br /><div class="row">'; $i = 1;} ?>
            <div class="column-responsive column-<?= $porcentByPost ?>">
            	<div class="articles view content">
                    <div>
                    	<?php
                    	if (($article->image_name) && (is_file(WWW_ROOT . 'img/articles/' . $article->image_name))) {
                    	    echo $this->Html->image('articles/' . $article->image_name, ['url' => '/' . __('article') . '/' . $article->slug]); //['action' => 'detail', $article->slug], 'alt' => 'Image']);
                    	} else {
                    	    echo $this->Html->image('no-image-available.jpeg', ['url' => '/' . __('article') . '/' . $article->slug]); //['action' => 'detail', $article->slug], 'alt' => 'No Image']);
                    	}
                    	?>
                    </div>
                    <h3>
                    	<?= $this->Html->link($article->title, '/' . __('article') . '/' . $article->slug) ?>
                    </h3>
                    <p>
                    	<?= h($article->created->format('d/m/Y')) ?>
                    </p>
                    <!--
                    <p>
                    	<?= __('Tags') ?>:
                    	<?php
                    	    foreach ($article->tags as $tag) {
                    		    echo $tag->title . ' ';
                    	    }
                    	?>
                    </p>
                    -->
                </div>
            </div>
        <?php $i++; ?>
    <?php endforeach; ?>
</div>

<br />

<div class="articles index content">
    <h3><i class="fas fa-camera"></i> <?= __('Portfolio') ?></h3>    
</div>

<br />

<div class="row">
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	echo $this->Html->image('portfolio/1.jpg', ['alt' => 'Image']);
            	?>
            </div>
            <h3>
            	AITA
            </h3>
            <p>
            	Enero 2021
            </p>
        </div>
    </div>
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	echo $this->Html->image('portfolio/2.jpg', ['alt' => 'Image']);
            	?>
            </div>
            <h3>
            	Aquotech
            </h3>
            <p>
            	Febrero 2021
            </p>
        </div>
    </div>
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	echo $this->Html->image('portfolio/3.jpg', ['alt' => 'Image']);
            	?>
            </div>
            <h3>
            	Cyber Oprac
            </h3>
            <p>
            	Marzo 2021
            </p>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	echo $this->Html->image('portfolio/4.jpg', ['alt' => 'Image']);
            	?>
            </div>
            <h3>
            	Infinity Air
            </h3>
            <p>
            	Enero 2021
            </p>
        </div>
    </div>
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	echo $this->Html->image('portfolio/5.jpg', ['alt' => 'Image']);
            	?>
            </div>
            <h3>
            	Negocios Líquidos
            </h3>
            <p>
            	Febrero 2021
            </p>
        </div>
    </div>
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	echo $this->Html->image('portfolio/6.jpg', ['alt' => 'Image']);
            	?>
            </div>
            <h3>
            	Serenata Guayanesa
            </h3>
            <p>
            	Marzo 2021
            </p>
        </div>
    </div>
</div>

<br />

<div class="articles index content">
    <h3><i class="fas fa-tools"></i> <?= __('Technologies') ?></h3>    
</div>

<br />

<div class="row">
    <div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	   echo $this->Html->image('techs/html5.jpg', ['alt' => 'HTML']);
            	?>
            </div>
            <h3>
            	HTML
            </h3>
        </div>
    </div>
    <div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	   echo $this->Html->image('techs/css3.jpg', ['alt' => 'CSS']);
            	?>
            </div>
            <h3>
            	CSS
            </h3>
        </div>
    </div>
    <div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	   echo $this->Html->image('techs/jquery.jpg', ['alt' => 'JQuery']);
            	?>
            </div>
            <h3>
            	JQuery
            </h3>
        </div>
    </div>
    <div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	   echo $this->Html->image('techs/bootstrap.jpg', ['alt' => 'Bootstrap']);
            	?>
            </div>
            <h3>
            	Bootstrap
            </h3>
        </div>
    </div>
    <div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	   echo $this->Html->image('techs/cakephp.jpg', ['alt' => 'CakePHP']);
            	?>
            </div>
            <h3>
            	CakePHP
            </h3>
        </div>
    </div>
    <div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	   echo $this->Html->image('techs/wordpress.jpg', ['alt' => 'Wordpress']);
            	?>
            </div>
            <h3>
            	Wordpress
            </h3>
        </div>
    </div>
</div>

<br />

<div class="articles index content">
    <h3><i class="fas fa-envelope"></i> <?= __('Contact') ?></h3>    
</div>

<br />

<div class="row">
    <div class="column-responsive column-4 contact">
    	<div class="articles view content">
            <div class="contact-col">
            	<i class="fas fa-phone"></i>
				<br /><br />
				<h3><?php echo __('Phone'); ?></h3>
				+54 (9) 11 27037330
            </div>
        </div>
    </div>
    <div class="column-responsive column-4 contact">
    	<div class="articles view content">
            <div class="contact-col">
            	<i class="fas fa-map-marker-alt"></i>
				<br /><br />
				<h3><?php echo __('Office'); ?></h3>
				Barracas, Buenos Aires, Argentina.
            </div>
        </div>
    </div>
    <div class="column-responsive column-4 contact">
    	<div class="articles view content">
            <div class="contact-col">
            	<i class="fas fa-at"></i>
            	<br /><br />
				<h3><?php echo __('Email'); ?></h3>
				info<i class="fas fa-at small-icon"></i>rubencamargo.com.ar
            </div>
        </div>
    </div>
</div>

<br />
