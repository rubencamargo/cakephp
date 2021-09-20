<div class="row">
    <div class="column-responsive">
    	<?= $this->Flash->render() ?>
        
        <div class="users form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Login') ?></legend>
                <br />
                <?php
                    echo $this->Form->control('email', ['placeholder' => __('Email'), 'label' => false, 'autocomplete' => 'off']);
                    echo $this->Form->control('password', ['placeholder' => __('Password'), 'label' => false, 'autocomplete' => 'off']);
                ?>
            </fieldset>
            
            <?= $this->Form->button(__('Login')) ?>
            <?= $this->Html->link(__('Register'), ['action' => 'add'], ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
            
        </div>
    </div>
</div>
