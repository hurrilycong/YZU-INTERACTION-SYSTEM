<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherWork */
/* @var $form yii\widgets\ActiveForm */




/*
 * 此文件要修改
 */
?>



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    
    <?php
        $item1 = [1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9,10 => 10,11 => 11,12 => 12];
    ?>
    
    <?= $form->field($model, 'deadline_mon')->dropDownList($item1,['prompt' => '请选择']) ?>
    
    <?php
        $item2 = [1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9,10 => 10,11 => 11,12 => 12,13 => 13,
            14 => 14,15 => 15,16 => 16,17 => 17, 18 => 18,19 => 19,20 => 20,21 => 21,22 => 22,23 => 23,24 => 24,
            25 => 25,26 => 26,27 => 27,28 => 28,29 => 29,30 => 30,31 => 31];
    ?>
    <?php
        //此处仍有问题，即二月是28天还是29天的问题，以及30天和31天的区别
        //没有设置，以后更改
    ?>
    <?= $form->field($model, 'deadline_day')->dropDownList($item2,['prompt' => '请选择']) ?>

    <div class="form-group">
        <?= Html::submitButton('发布', ['class' => 'btn btn-success']) ?>
        <?=            Html::a('取消', ['index'], ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>
     <?php if(isset($lastupdate)){
        echo '上次更新'+ Yii::$app->formatter->asDatetime($lastupdate, "php:mhi");
    }?>


