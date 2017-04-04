<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['teacher-course/index']];
$this->title = '删除留言';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('info')): ?>
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <?= Yii::$app->session->getFlash('info') ?>
    </div>
    <?php endif; ?>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
        <?php $form = ActiveForm::begin([
        'id' => 'list-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            'message_title',
            'message_content',
            [
                'class' => 'yii\grid\ActionColumn','header' => '操作',
               'template' => '{delete}',
            ],
        ],
    ]); ?>
    <?=Html::submitButton('确认选中项', ['class' => 'btn btn-info','name' => 'submit-button']);?>
    <?= Html::resetButton('删除选中项', ['class' => 'btn btn-info','name' => 'reset-button']);?>
     <?php ActiveForm::end(); ?>
</div>