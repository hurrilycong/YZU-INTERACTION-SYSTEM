<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CourseNotice */

$this->title = 'Update Course Notice: ' . $model->notice_id;
$this->params['breadcrumbs'][] = ['label' => 'Course Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->notice_id, 'url' => ['view', 'id' => $model->notice_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-notice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
