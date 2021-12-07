<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Article') ?></legend>
                <?php
                    //echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('type_id');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('body');
                    
                    if (($article->image_name) && (is_file(WWW_ROOT . 'img/articles/' . $article->image_name))) {
                        echo $this->Html->image('articles/' . $article->image_name, ['width' => '200']);
                    } else {
                        echo $this->Html->image('no-image-available.jpeg', ['width' => '200']);
                    }
                    
                    echo $this->Form->control('image', ['type' => 'file']);
                    echo $this->Form->control('published');
                    echo $this->Form->control('tags._ids', ['options' => $tags, 'size' => 5]);
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