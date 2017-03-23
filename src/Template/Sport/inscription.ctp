<div class="users form">
<?= $this->Form->create("formulaire", ['enctype' => 'multipart/form-data']); ?>
    <fieldset>
        <legend><?= __('Sinscrire') ?></legend>
        <?= $this->Form->input('email') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
<?= $this->Form->button(__('Inscription')); ?>
<?= $this->Form->end() ?>
</div>
