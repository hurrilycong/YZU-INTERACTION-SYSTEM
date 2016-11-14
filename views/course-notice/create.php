<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CourseNotice */

$this->title = 'Create Course Notice';
$this->params['breadcrumbs'][] = ['label' => 'Course Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-notice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
