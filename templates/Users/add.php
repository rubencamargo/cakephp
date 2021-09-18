<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */
?>
<div class="row">
    <div class="column-responsive">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Register') ?></legend>
                <?php
                    echo $this->Form->hidden('role_id', ['options' => $roles, 'value' => 2]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('lastname');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('retype_password', ['type' => 'password']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
