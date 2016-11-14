<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CourseNotice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-notice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'notice_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notice_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'course_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
