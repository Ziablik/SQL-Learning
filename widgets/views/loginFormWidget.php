<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

Modal::begin([
    'header'=>'<h4>Login</h4>',
    'id'=>'login-modal',
]);
?>
<?= $this->render('/_menu'); ?>


<p>Пожалуйста введите свой логин и пароль, чтобы авторизироваться</p>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-login']
]);
echo $form->field($model, 'username')->textInput();
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'rememberMe')->checkbox();
?>

<div>
    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
</div>
<div class="form-group">
    <div class="text-right">

        <?php
        echo Html::button('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
        echo Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']);
        ?>

    </div>
</div>

<?php
ActiveForm::end();
Modal::end();