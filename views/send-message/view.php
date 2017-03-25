<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherWork */

$this->title = '留言详情';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/teacher-course/index']];
$this->params['breadcrumbs'][] = ['label' => '未读留言', 'url' => ['send-message/unread-message']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-work-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('回复', ['answer'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete'], [
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
            //'message_id',
            'message_title',
            'message_content:ntext',
            'message_date:datetime',
            [
                'label' => '课程',
                'value' => $model->course->course_name,
            ],
            //'twork_update:datetime',
            [
                'label' => '来自',
                'value' => $model->studentNumber->studentNumber->user_name,
            ],
            //'twork_deadline:datetime',
            // 'tworkFilesLink:raw'
        ],
    ]) ?>

</div>
