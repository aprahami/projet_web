<div id="image_profil">
<?php

if(!file_exists('C:/wamp64/www/webproject/webroot/img/avatars/'.$infos['id'].'.jpg')) : ?>

	<img src="/webproject/webroot/img/avatar.png"  >

<?php 

else : echo $this->Html->image('avatars/'.$infos['id'].'.jpg');
endif;
echo $this->Form->create("formulaire_photo", ['enctype' => 'multipart/form-data']); 
echo $this->Form->input('photo', array('label' => 'Photo profil (au format png ou jpg)', 'type' => 'file')); 
echo $this->Form->button(__('Changer de photo'));
echo $this->Form->end();
// Rafraichissez le cache avec ctrl+f5 pour afficher la nouvelle photo
?>
</div>


<?php
if($uid!=null)
{
	echo "<p>Bienvenue :<br/> Votre adresse mail est $infos[email]</p>";
}
?>
