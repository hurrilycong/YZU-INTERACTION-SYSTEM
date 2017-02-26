<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = '请选择课程';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['student-course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        
        <?php
            $allStatus = app\models\StudentCourse::find()
                                        ->select(['course_id'])
                                        ->where(['student_number' => \Yii::$app->user->getId()],['verified' => 1])
                                        ->indexBy('course_id')
                                        ->column()
        ?>
    
        <?= $form->field($model, 'student_class')->dropDownList($allStatus,['prompt' => '请选择']) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('确认', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?=                        Html::a('返回', ['index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>