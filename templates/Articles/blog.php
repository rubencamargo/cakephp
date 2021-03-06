<div class="articles index content">
    <h3><?= __('Blog') ?></h3>
    
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('search', ['name' => 'search', 'label' => false, 'placeholder' => __('Articles search by title')]);
        ?>
    </fieldset>
    <?php //echo $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
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
                    	    echo $this->Html->image('articles/' . $article->image_name, ['url' => '/' . __('article') . '/' . $article->slug]); //['action' => 'detail', $article->slug]]);
                    	} else {
                    	    echo $this->Html->image('no-image-available.jpeg', ['url' => '/' . __('article') . '/' . $article->slug]); //['action' => 'detail', $article->slug]]);
                    	}
                    	?>
                    </div>
                    <h3>
                    	<?php echo $this->Html->link($article->title, ['action' => 'detail', $article->slug]) ?>
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
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>