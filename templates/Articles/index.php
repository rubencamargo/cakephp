<div class="articles index content">
    <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Articles') ?></h3>
    
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('search', ['name' => 'search', 'label' => false, 'placeholder' => __('Articles search by title')]);
        ?>
    </fieldset>
    <?php //echo $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= __('Image') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <!-- <th><?= $this->Paginator->sort('slug') ?></th> -->
                    <th>Tags</th>
                    <th><?= $this->Paginator->sort('published') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $this->Number->format($article->id) ?></td>
                    <td>
                    	<?php
                    	if (($article->image_name) && (is_file(WWW_ROOT . 'img/articles/' . $article->image_name))) {
                    	    echo $this->Html->image('articles/' . $article->image_name, ['width' => '50px']);
                    	} else {
                    	    echo $this->Html->image('no-image-available.jpeg', ['width' => '50px']);
                    	}
                    	?>
                    </td>
                    <td><?= $article->has('user') ? $article->user->name . ' ' . $article->user->lastname : '' ?></td>
                    <td><?= h($article->title) ?></td>
                    <!-- <td><?= h($article->slug) ?></td> -->
                    <td>
                    	<?php
                    	    foreach ($article->tags as $tag) {
                    		    echo $tag->title . ' ';
                    	    }
                    	?>
                    </td>
                    <td>
                    	<?php //echo $article->published ? __('Yes') : __('No'); ?>
                    	<?= $this->Form->postLink(h($article->published) ? __('Yes') : __('No'), ['action' => 'changeStatus', $article->id, $article->published], ['title' => __('Change status'), 'confirm' => __('Are you sure you want to {0}?', h($article->published) ? __('Unpublish') : __('Publish'))]) ?>
                    </td>
                    <td><?= h($article->created->format('d/m/y H:i:s')) ?></td>
                    <td><?= h($article->modified->format('d/m/y H:i:s')) ?></td>
                    <td nowrap="nowrap" class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
