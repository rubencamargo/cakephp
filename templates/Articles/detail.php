<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row content">
	<div class="column-responsive column-60">
		<div class="articles view">
			<h1><?= h($article->title) ?></h1>
            <span><?= h($article->created->format('d/m/y H:i:s')) ?></span>
            
            <blockquote>
                <?= $this->Text->autoParagraph(($article->body)); ?>
            </blockquote>
		</div>
		
		<?php if ($this->request->getSession()->check('Auth')) { ?>
		
		<hr />
		
		<div class="column-responsive column">
            <div class="comments form content">
                <?= $this->Form->create(null, ['url' => ['action' => 'add-comment']]) ?>
                <fieldset>
                    <legend><?= __('Add Comment') ?></legend>
                    <?php
                        echo $this->Form->hidden('article_id', ['value' => $article->id]);
                        echo $this->Form->hidden('user_id', ['value' => $this->request->getSession()->read('Auth.id')]);
                        echo $this->Form->control('comment');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
        
        <?php } ?>
        
        <?php if (!empty($article->comments)) { ?>
        <hr />
		
        <h3><?= __('Comments') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>
                        	<?= __('Comment') ?>
                        </th>
                        <th><?= __('Date') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($article->comments as $comment): ?>
                    <tr>
                        <td>
                        	<i class="fa fa-pencil comment-icon"></i>&nbsp;&nbsp;
                        	<?= $comment->comment ?>
                        	<?php if ($comment->response) { ?>
                        	<br />
                        	<i class="fa fa-check comment-icon"></i>&nbsp;&nbsp;
                        	<?= $comment->response ?>
                        	<?php } ?>
                        </td>
                        <td><?= h($comment->created) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
        
        <br />
        
        <div class="message warning">
        	<?php echo __('Login for comment.') ?>
        </div>
        <?php } ?>
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
