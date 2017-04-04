<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->user_name.'的个人中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    $countS = \app\models\StudentCourse::getPengdingStuCount();
    $countM = \app\models\CourseMessage::getPendingMessageCount();
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    
        <?= Html::a('更新资料', ['update-user'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('我的课程', ['/teacher-course/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('未读留言<span class="badge">'.$countM.'</span>', ['/send-message/unread-message'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('未批准申请<span class="badge">'.$countS.'</span>', ['/teacher-course/unread-application'], ['class' => 'btn btn-info'])?>
    
    
    <div class="grid-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_number',
            'user_name',
            'teacherInformation.teacher_introduction',
            [
                'attribute' => 'teacherInformation.teacher_college',
                'value' => $model->teacherInformation->teacherCollege->cname
            ],
            'teacherInformation.teacher_phone',
            'teacherInformation.teacher_email'
        ],
    ]) ?>
    </div>

