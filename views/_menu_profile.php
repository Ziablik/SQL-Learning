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
                ['label' => 'Данные профиля', 'url' => ['/profile/view']],
                ['label' => 'Мои курсы', 'url' => ['/course/index']],
                ['label' => 'Мои группы', 'url' => ['/group/index']],
                ['label' => 'Мои задачи', 'url' => ['/question/index']],
            ],
        ]);
        ?>
    </div>
</div>