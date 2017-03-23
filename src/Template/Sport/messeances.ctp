<?php foreach ($workouts as $value) {
    echo $value['sport']." "; 
    echo $value['date']." "; 
    echo $value['end_date']." "; 
    echo $value['location_name']." "; 
    echo $value['description']." "; 
    ?>
    <br/>
    <?php
}
?>
<div class="workouts form large-9 medium-8 columns content">
    <?= $this->Form->create("workouts") ?>
    <fieldset>
        <legend><?= __('Add Workout') ?></legend>
        <?php
            echo $this->Form->input('date', array('name' => 'date', 'type' => 'datetime', 'required'=>'true'));
            echo $this->Form->input('end_date', array('name' => 'end_date',  'type' => 'datetime', 'required'=>'true'));
            echo $this->Form->input('location_name', array('name' => 'location_name', 'required'=>'true'));
            echo $this->Form->input('description', array('name' => 'description', 'required'=>'true'));
            echo $this->Form->input('sport', array('name' => 'sport', 'required'=>'true'));
            echo $this->Form->input('contest_id', ['name' => 'contests', 'empty'=>'true' ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
