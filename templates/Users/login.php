<div class="row">
    <div class="column-responsive">
    	<?= $this->Flash->render() ?>
        
        <div class="users form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('Login') ?></legend>
                <?php
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Login')) ?>
            <?= $this->Html->link(__('Register'), ['action' => 'add'], ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
            
        </div>
    </div>
</div>
