<div class="articles index content">
    <h3><?= __('Blog') ?></h3>
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
                    <h3><?= h($article->id) ?> <?= h($article->title) ?></h3>
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