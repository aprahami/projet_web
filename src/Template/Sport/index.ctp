<h1> Accueil </h1>

<div class="users form">
<?= $this->Form->create("Members") ?>
    <fieldset>
        <legend><?= __('Se connecter') ?></legend>
        <?= $this->Form->input('email') ?>
        <?= $this->Form->input('password') ?>
        <input type='hidden' name='index' value='connexion'>
    </fieldset>
<?= $this->Form->button(__('Connexion')); ?>
<?= $this->Form->end() ?>
<a href="http://localhost/webproject/sport/inscription"> Pas de compte ? Inscrivez-vous </a>
<br/>
<a href="#" onClick="hide('passForget'); return false;"> Mot de passe oublié ? </a> 
<div id='passForget'>
<?= $this->Form->create("Mdp") ?>
    <fieldset>
        <legend><?= __('Mot de passe oublié') ?></legend>
        <?= $this->Form->input('email') ?>
        <input type='hidden' name='index' value='mdpoublie'>
    </fieldset>
<?= $this->Form->button(__('Envoyer un email avec un nouveau mot de passe')); ?>
<?= $this->Form->end() ?>
</div>