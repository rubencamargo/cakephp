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


<?php if ($portfolios->count()) { ?>
<br />

<div class="articles index content">
    <h3><i class="fas fa-camera"></i> <?= __('Portfolio') ?></h3>    
</div>

<br />

<div class="row">
	<?php
	$columns = 3;
	$i = 1;
	?>
	
    <?php foreach ($portfolios as $portfolio) { ?>
    <div class="column-responsive column-4 portfolio">
    	<div class="articles view content">
            <div>
            	<?php
            	if (($portfolio->image_name) && (is_file(WWW_ROOT . 'img/articles/' . $portfolio->image_name))) {
            	    echo $this->Html->image('articles/' . $portfolio->image_name, ['alt' => $portfolio->image_name]);
            	} else {
            	    echo $this->Html->image('no-image-available.jpeg', ['alt' => $portfolio->image_name]);
            	}
            	?>
            </div>
            <h3>
            	<?= h($portfolio->title) ?>
            </h3>
            <p>
            	<?= $portfolio->body ?>
            </p>
        </div>
    </div>
    
    <?php if ($i % $columns == 0) {echo "</div><br /><div class='row'>";} ?>
    
    <?php $i++; ?>
    <?php } ?>
</div>
<?php } ?>

<?php if ($technologies->count()) { ?>
<br />

<div class="articles index content">
    <h3><i class="fas fa-tools"></i> <?= __('Technologies') ?></h3>    
</div>

<br />

<div class="row">
    <?php
	$columns = 6;
	$i = 1;
	?>
	
	<?php foreach ($technologies as $technology) { ?>
	<div class="column-responsive column-2 technologies">
    	<div class="articles view content">
            <div>
            	<?php
            	if (($technology->image_name) && (is_file(WWW_ROOT . 'img/articles/' . $technology->image_name))) {
            	    echo $this->Html->image('articles/' . $technology->image_name, ['alt' => $technology->image_name]);
            	} else {
            	    echo $this->Html->image('no-image-available.jpeg', ['alt' => $technology->image_name]);
            	}
            	?>
            </div>
            <h3>
            	<?php echo $technology->title ?>
            </h3>
        </div>
    </div>
    
    <?php if ($i % $columns == 0) {echo "</div><br /><div class='row'>";} ?>
    
    <?php $i++; ?>
    <?php } ?>
</div>
<?php } ?>

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
