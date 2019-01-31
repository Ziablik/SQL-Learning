<?php

use yii\widgets\Menu;

?>
<div class="row">
    <div class="col-md-12">
        <?=
        Menu::widget([
            'options' => [
                'class' => 'nav nav-tabs',
            ],
            'items' => [
                ['label' => 'Вход', 'url' => ['/site/login']],
                ['label' => 'Регистрация', 'url' => ['/site/signup']],
            ],
        ]);
        ?>
    </div>
</div>