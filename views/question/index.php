<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Практические задачи');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/_menu_profile'); ?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать задачу'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'text_quest:ntext',
            'code_quest:ntext',
            'key_word:ntext',
            'key_wrong_word:ntext',
            [
                'attribute' => 'course',
                'value' => 'course.name_course'
],
            [
                'attribute' => 'user',
                'value' => 'course.user.username'
],
            //'point',
            //'course_id',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
