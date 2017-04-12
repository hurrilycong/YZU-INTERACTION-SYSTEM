<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherWork */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'test_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'test_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'test_answer')->textInput()?>

    <?= $form->field($model, 'test_score')?>

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
        <?=            Html::a('取消', ['index'], ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

