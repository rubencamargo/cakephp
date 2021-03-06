<div class="users index content">
	<?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <?php
            echo $this->Form->control('search', ['name' => 'search', 'label' => false, 'placeholder' => __('Users search by name, lastname and email')]);
        ?>
    </fieldset>
    <?php //echo $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('lastname') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('country_code', __('Country')) ?></th>
                    <th><?= $this->Paginator->sort('active') ?></th>
                    <th><?= $this->Paginator->sort('last_login') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->lastname) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td style="text-align: center;">
                    	<?php //echo $user->country_code; ?>
                    	<?php //debug($user->country_flag); ?>
                    	<?php echo $this->Html->image($user->country_flag, ['alt' => $user->country_code, 'title' => $user->country_name, 'width' => '20px']); ?>
                    	<br>
                    	<?php echo $user->city; ?>
                    </td>
                    <td>
                    	<?php //h($user->active) ? __('Yes') : __('No'); ?>
                    	<?= $this->Form->postLink(h($user->active) ? __('Yes') : __('No'), ['action' => 'changeStatus', $user->id, $user->active], ['title' => __('Change status'), 'confirm' => __('Are you sure you want to {0}?', h($user->active) ? __('Deactivate') : __('Activate'))]) ?>
                    </td>
                    <td><?= h($user->last_login->format('d/m/y H:i:s')) ?></td>
                    <td><?= h($user->created->format('d/m/y H:i:s')) ?></td>
                    <td><?= h($user->modified->format('d/m/y H:i:s')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
