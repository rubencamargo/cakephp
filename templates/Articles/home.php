<div class="articles index content">
    <h3><?= __('News') ?></h3>
</div>

<br />

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
