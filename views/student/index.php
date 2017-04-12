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
<?php
$countN = \app\models\CourseNoticeBroadcast::find()->where(['student_number' => Yii::$app->user->getId(),'is_read' => 0])->count();
$countW = app\models\TeacherWork::find()->innerJoin('student_course','student_course.course_id = teacher_work.course_id')
                                    ->where(['verified' => 1,'student_number' => Yii::$app->user->getId()])
                                    ->count();
$countS = app\models\StudentWork::find()->where(['user_number' => Yii::$app->user->getId()])->count();

/* @var $count int */
$count = $countW-$countS;
?>
    
    <p>
        <?= Html::a('更新资料', ['update-user'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('我的课程', ['/student-course/index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('未交作业<span class="badge">'.$count.'</span>', ['/student-work/unfinished-works'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('未读通知<span class="badge">'.$countN.'</span>', ['/student-course/all-course-notices', 'status' => 0], ['class' => 'btn btn-info']) ?>
        <?= Html::a('未完成测试', ['/common-test/unfinished-tests'],['class' => 'btn btn-info'])?>
        <?= Html::a('发送留言', ['/send-message/index'], ['class' => 'btn btn-info'])?>
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
