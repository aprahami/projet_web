<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sticker->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sticker->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stickers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Earnings'), ['controller' => 'Earnings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Earning'), ['controller' => 'Earnings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stickers form large-9 medium-8 columns content">
    <?= $this->Form->create($sticker) ?>
    <fieldset>
        <legend><?= __('Edit Sticker') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
