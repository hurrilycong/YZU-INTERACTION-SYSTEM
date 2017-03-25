<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherWork */

$this->title = '未读留言';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/teacher-course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        /*
        <?= Html::a('删除留言', ['delete', 'id' => $model->twork_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除?',
                'method' => 'post',
            ],
        ]) ?> 
         
         */
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => '暂无数据',
        'columns' => [
            'message_title',
            'message_content:ntext',
            'message_date:datetime',
            //'course_id',
            [
                'attribute' => 'course_id',
                'value' => 'course.course_name'
            ],
            [
                'attribute' => 'student_number',
                'value' => 'studentNumber.studentNumber.user_name'
            ],
            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}{delete}',
                ],
        ],
    ]) ?>
</div>
