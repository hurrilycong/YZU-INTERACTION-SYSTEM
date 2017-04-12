<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherWork */

$this->title = $model->test_title;
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/teacher-course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=        Html::a('更新测试', ['update', 'id' => $model->test_id], ['class' => 'btn btn-primary']) ?>
        <?=        Html::a('推送测试', ['boardcast', 'id' => $model->test_id],[
            'class' => 'btn btn-info',
            'data' => [
                'confirm' => '确认推送?',
                'method' => 'post',
            ]
        ])?>
        <?=        Html::a('删除测试', ['delete', 'id' => $model->test_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'test_id',
            'test_title',
            'test_content',
            'test_answer',
            'test_score',
            'dead_line:date',
            'test_date:date',
        ],
    ]) ?>

</div>
