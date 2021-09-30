<?php if ($articles->count()) { ?>
<div class="articles index content">
    <h3><?= __('News') ?></h3>
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
                    	    echo $this->Html->image('articles/' . $article->image_name, ['url' => ['action' => 'detail', $article->slug]]);
                    	} else {
                    	    echo $this->Html->image('no-image-available.jpeg', ['url' => ['action' => 'detail', $article->slug]]);
                    	}
                    	?>
                    </div>
                    <h3>
                    	<?= $this->Html->link($article->title, ['action' => 'detail', $article->slug]) ?>
                    </h3>
                    <p>
                    	<?= h($article->created->format('d/m/Y')) ?>
                    </p>
                    <p>
                    	<?= __('Tags') ?>:
                    	<?php
                    	    foreach ($article->tags as $tag) {
                    		    echo $tag->title . ' ';
                    	    }
                    	?>
                    </p>
                </div>
            </div>
        <?php $i++; ?>
    <?php endforeach; ?>
</div>

<br />

<div class="articles index content">
    <h3><?= __('Portfolio') ?></h3>    
</div>

<br />

<div class="row">
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
            	<?php
            	    echo $this->Html->image('portfolio/1.jpg');
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
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
            	<?php
            	    echo $this->Html->image('portfolio/2.jpg');
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
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
            	<?php
            	    echo $this->Html->image('portfolio/3.jpg');
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
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
            	<?php
            	    echo $this->Html->image('portfolio/4.jpg');
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
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
            	<?php
            	    echo $this->Html->image('portfolio/5.jpg');
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
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
            	<?php
            	    echo $this->Html->image('portfolio/6.jpg');
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
    <h3><?= __('Contact') ?></h3>    
</div>

<br />

<div class="row">
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
				<h3><?php echo __('Phone'); ?></h3>
				+54 11 27037330
            </div>
        </div>
    </div>
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
				<h3><?php echo __('Office'); ?></h3>
				Barracas, Buenos Aires, Argentina.
            </div>
        </div>
    </div>
    <div class="column-responsive column-4">
    	<div class="articles view content">
            <div>
				<h3><?php echo __('Email'); ?></h3>
				rubencamargo@gmail.com
            </div>
        </div>
    </div>
</div>

<br />

