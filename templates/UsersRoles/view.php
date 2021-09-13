<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersRole $usersRole
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Users Role'), ['action' => 'edit', $usersRole->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Users Role'), ['action' => 'delete', $usersRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersRole->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Users Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usersRoles view content">
            <h3><?= h($usersRole->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($usersRole->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($usersRole->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($usersRole->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($usersRole->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
