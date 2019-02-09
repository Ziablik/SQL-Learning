<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;

$this->title = 'Выполнение заданий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        Краткая информация о базе данных "Компьютерная фирма":

        Схема БД состоит из четырех таблиц:<br>
        Product(maker, model, type)<br>
        PC(code, model, speed, ram, hd, cd, price)<br>
        Laptop(code, model, speed, ram, hd, price, screen)<br>
        Printer(code, model, color, type, price)<br>
        Таблица Product представляет производителя (maker), номер модели (model) и
        тип ('PC' - ПК, 'Laptop' - ПК-блокнот или 'Printer' - принтер). Предполагается,
        что номера моделей в таблице Product уникальны для всех производителей и типов
        продуктов. В таблице PC для каждого ПК, однозначно определяемого уникальным кодом
        – code, указаны модель – model (внешний ключ к таблице Product), скорость - speed
        (процессора в мегагерцах), объем памяти - ram (в мегабайтах), размер диска - hd (в гигабайтах),
        скорость считывающего устройства - cd (например, '4x') и цена - price. Таблица Laptop
        аналогична таблице РС за исключением того, что вместо скорости CD содержит размер экрана
        -screen (в дюймах). В таблице Printer для каждой модели принтера указывается, является
        ли он цветным - color ('y', если цветной), тип принтера - type (лазерный – 'Laser',
        струйный – 'Jet' или матричный – 'Matrix') и цена - price.
    </div>
    </br>
    <div class="row">
        <div class="col-lg-4">
            <?= $quest->text_quest ?>
        </div>

        <div class="col-lg-8">
            <div class="code-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($quest, 'codeByStudent')->textarea()?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <h2 class="text-center">
            <!--            --><?php //if( Yii::$app->session->hasFlash('error') ): ?>
            <!--                <div class="alert alert-error alert-dismissible" role="alert">-->
            <!--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            <!--                    --><?php //echo Yii::$app->session->getFlash('error'); ?>
            <!--                </div>-->
            <!--            --><?php //endif;?>
            <?php
            if(!empty($resultText))
            {
                echo $resultText;
            }
            ?>
        </h2>
    </div>
</div>
