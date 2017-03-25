<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Cakephp';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('moncompte.css') ?>
    <?= $this->Html->css('connexion.css') ?>
    <?= $this->Html->script('script.js')  ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">


        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href="">Sport+</a></h1>
            </li>
        </ul>


        <div class="top-bar-section">
            <ul class="right">
                <?php if($loggedIn) : ?>
                 <li><?= $this->Html->link('Logout',['controller' => 'Sport', 'action' => 'logout']); ?> </li>
                 <li><?= $this->Html->link('Mon compte' ,['controller' => 'Sport', 'action' => 'mon_compte']); ?> </li>
                <?php else : ?>
                    <li><?= $this->Html->link('Inscription',['controller' => 'Sport', 'action' => 'inscription']); ?> </li>
            <?php endif; ?>
            </ul>
        </div>

    </nav>




    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        <a href="contacts.ctp">Contacts</a>
    </footer>
</body>
</html>
