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
                    echo $this->Form->control('lastname', ['placeholder' => __('Lastname'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('email', ['placeholder' => __('Email'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('password', ['placeholder' => __('Password'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('retype_password', ['type' => 'password', 'placeholder' => __('Retype Password'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->hidden('language', ['value' => $this->request->getSession()->read('Config.language')]);
                ?>
                
                <div class="captcha-box">
                	<?php
                    	$var1 = rand(0, 9);
                    	$var2 = rand(0, 9);
                	?>
                	
                	<div class="captcha-text">
                		<?= __("Write the result of") . " (" . $var1 . " + " . $var2 . "):"; ?> &nbsp;&nbsp;
                	</div>
                    
                    <div class="captcha-input">
                    <?php
                        echo $this->Form->hidden('var1', ['value' => $var1]);
                        echo $this->Form->hidden('var2', ['value' => $var2]);
                        echo $this->Form->hidden('res', ['value' => $var1 + $var2]);
                        echo $this->Form->control('captcha_local', ['class' => 'captcha', 'placeholder' => $var1 . " + " . $var2 . " = ", 'label' => false, 'autocomplete' => 'off', 'value' => '']);
                    ?>
                    </div>
                </div>
            </fieldset>
            
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
