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
                <br />
                <?php
                    echo $this->Form->hidden('role_id', ['options' => $roles, 'value' => 2]);
                    echo $this->Form->control('name', ['placeholder' => __('Name'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('lastname', ['placeholder' => __('Lastame'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('email', ['placeholder' => __('Email'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('password', ['placeholder' => __('Password'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('retype_password', ['type' => 'password', 'placeholder' => __('Retype Password'), 'label' => false, 'autocomplete' => 'off']);
                ?>
                
                <?php
                    $var1 = rand(0, 9);
                    $var2 = rand(0, 9);
                    echo $this->Form->hidden('var1', ['value' => $var1]);
                    echo $this->Form->hidden('var2', ['value' => $var2]);
                    $label = "Write the result of (" . $var1 . " + " . $var2 . "):";
                    
                    echo $this->Form->control('captcha_local', ['placeholder' => $label, 'label' => false, 'autocomplete' => 'off']);
                ?>
            </fieldset>
            
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
