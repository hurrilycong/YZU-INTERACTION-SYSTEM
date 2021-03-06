<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CourseNotice */

$this->title = $model->notice_id;
$this->params['breadcrumbs'][] = ['label' => 'Course Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-notice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->notice_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->notice_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'notice_id',
            'notice_title',
            'notice_content:ntext',
            'notice_date',
            'course_id',
        ],
    ]) ?>

</div>
