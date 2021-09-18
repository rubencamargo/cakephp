<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row content">
	<div class="column-responsive column-60">
		<div class="articles view">
			<h3><?= h($article->title) ?></h3>
            <span><?= h($article->created->format('d/m/y H:i:s')) ?></span>
            
            <blockquote>
                <?= $this->Text->autoParagraph(h($article->body)); ?>
            </blockquote>
		</div>
	</div>
    
    <div class="column-responsive column-40">
        <div class="articles view">
            
            <div class="text">
                <div>
                	<?php
                	if (($article->image_name) && (is_file(WWW_ROOT . 'img/articles/' . $article->image_name))) {
                	    echo $this->Html->image('articles/' . $article->image_name);
                	} else {
                	    echo $this->Html->image('no-image-available.jpeg');
                	}
                	?>
                </div>
                
            </div>
        </div>
    </div>
</div>
