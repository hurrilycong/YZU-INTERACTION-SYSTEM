<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentWork */

$this->title = 'Create Student Work';
$this->params['breadcrumbs'][] = ['label' => 'Student Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
