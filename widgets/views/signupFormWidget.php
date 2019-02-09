<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

Modal::begin([
    'header'=>'<h4>Login</h4>',
    'id'=>'signup-modal',
]);
?>
<?= $this->render('/_menu'); ?>


    <p>Пожалуйста заполните все поля для регистрации</p>

<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-signup']
]);
?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <div class="text-right">

            <?php
            echo Html::button('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
            echo Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']);
            ?>

        </div>
    </div>

<?php
ActiveForm::end();
Modal::end();