<?php
    $idform=1;
    //echo date("Y-m-d H:i:s"); //Date en retard de deux heures mais programme fonctionnel, à tester avec 2 heures en moins
    foreach ($workouts as $value) {
    echo $value['sport']." "; 
    echo $value['date']." - "; 
    echo $value['end_date']." "; 
    echo $value['location_name']." "; 
    echo $value['description']." ";
    $test="releveseance".$idform;
    if($value['end_date']->isPast() &&  $value['date'] != $value['end_date'])
    { 
        echo('(Réalisée)');
        echo '<a href="#" onClick="hide('."'".$test."'".'); return false;"> Ajouter un relevé ? </a>';
        echo'<div id='.$test.' style="display:none">';
        ?>
        <?= $this->Form->create("releveseance") ?>
        <fieldset>
            <legend><?= __('Ajouter un relevé') ?></legend>
        <?php
        echo $this->Form->input('Id utilisateur', array('name' => 'id_membre', 'value'=> $uid, 'disabled'=>'disabled'));
        echo $this->Form->input('Id séance', array('name' => 'id_seance', 'value'=> $value['id'], 'disabled'=>'disabled'));
        ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
        <?php
    }
    else if ((!$value['end_date']->isPast()) && $value['date']->isPast()) {
        echo('(En cours)');       
        echo '<a href="#" onClick="hide('."'".$test."'".'); return false;"> Ajouter un relevé ? </a>';
        echo'<div id='.$test.' style="display:none">';?>    
        <?= $this->Form->create("releveseance") ?>
        <fieldset>
            <legend><?= __('Ajouter un relevé') ?></legend>
        <?php
        echo $this->Form->input('Id utilisateur', array('name' => 'id_membre', 'value'=> $uid, 'disabled'=>'disabled'));
        echo $this->Form->input('Id séance', array('name' => 'id_seance', 'value'=> $value['id'], 'disabled'=>'disabled')); 
        ?>
         </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
        <?php
    }
    else if ($value['date']==$value['end_date'] && $value['date']->isPast())
    {
        echo('(Manquée)');
    }

    ?>
    <br/>
    <?php
    $idform++;
}
?>
<div class="workouts form large-9 medium-8 columns content">
    <?= $this->Form->create("workouts") ?>
    <fieldset>
        <legend><?= __('Ajouter une séance') ?></legend>
        <?php
            echo $this->Form->input('date', array('name' => 'date', 'type' => 'datetime', 'required'=>'true'));
            echo $this->Form->input('end_date', array('name' => 'end_date',  'type' => 'datetime', 'required'=>'true'));
            echo $this->Form->input('location_name', array('name' => 'location_name', 'required'=>'true'));
            echo $this->Form->input('description', array('name' => 'description', 'required'=>'true'));
            echo $this->Form->input('sport', array('name' => 'sport', 'required'=>'true'));
            echo $this->Form->input('contest_id', ['name' => 'contests', 'empty'=>  'true' ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
