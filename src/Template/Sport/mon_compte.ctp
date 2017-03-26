<div id="conteneur">
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
?>
<div id="description">
Rafraichissez le cache avec ctrl+f5 pour afficher la nouvelle photo
</div>

<?php
if($uid!=null)
{
	echo "<p>Bienvenue sur le meilleur site de sport du monde, t'en as de le chance!<br/>
			 Pour commencer, upload une photo bien badass de ta plus grosse séance de tractions<br/>
			 Aussi askip ton adresse mail c'est $infos[email]</p>";
}
?>
</div>
</div>