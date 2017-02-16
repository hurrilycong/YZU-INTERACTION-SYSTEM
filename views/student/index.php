<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentWork */

$this->title = $model->user_name.'的个人中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-center-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新资料', ['update-user'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('我的课程', ['/student-course/index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('未交作业', ['/student-work/unfinished-works'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('未读通知', ['/student-course/all-course-notices', 'status' => 0], ['class' => 'btn btn-info']) ?>
    </p>
    <div class="grid-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_number',
            'user_name',
            'studentInformation.student_class',
            //'studentInformation.student_college',
            [
                'attribute' => 'studentInformation.student_college',
                'value' => $model->studentInformation->studentCollege->cname
            ],
            //'studentInformation.student_major',
            [
                'attribute' => 'studentInformation.student_major',
                'value' => $model->studentInformation->studentMajor->mname
            ],
            'studentInformation.student_email',
            'studentInformation.student_phone',
        ],
    ]) ?>
    </div>
</div>
