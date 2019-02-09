<?php

use yii\widgets\Menu;
use app\widgets\LoginFormWidget;
use app\widgets\SignupFormWidget;

?>


<div class="row">
    <div class="col-md-12">
        <?=
        Menu::widget([
            'options' => [
                'class' => 'nav nav-tabs',
            ],
            'items' => [
                ['label' => 'Login', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#login-modal']],
                ['label' => 'Signup', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#signup-modal']],
            ],
        ]);
        ?>
    </div>
</div>