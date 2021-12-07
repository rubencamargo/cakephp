<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $tags
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Article') ?></legend>
                <?php
                    //echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('type_id');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('body');
                    echo $this->Form->control('image', ['type' => 'file']);
                    echo $this->Form->control('published');
                    echo $this->Form->control('tags._ids', ['options' => $tags]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?= $this->Html->script('https://cdn.tiny.cloud/1/h36uzevzp3mdwc7mfqnqe55jqc5rb7gt2g6tuik7tcaehisx/tinymce/5/tinymce.min.js', ['referrerpolicy' => 'origin']) ?>

<script type="text/javascript">
tinymce.init({
	selector: '#body',
	height: 500,
	plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	toolbar_mode: 'floating',
});
</script>