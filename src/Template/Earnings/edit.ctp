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
                ['action' => 'delete', $earning->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $earning->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Earnings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stickers'), ['controller' => 'Stickers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sticker'), ['controller' => 'Stickers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="earnings form large-9 medium-8 columns content">
    <?= $this->Form->create($earning) ?>
    <fieldset>
        <legend><?= __('Edit Earning') ?></legend>
        <?php
            echo $this->Form->input('member_id', ['options' => $members]);
            echo $this->Form->input('sticker_id', ['options' => $stickers]);
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
