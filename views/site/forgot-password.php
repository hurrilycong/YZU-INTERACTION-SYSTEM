<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '忘记密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请选择找回方式,先选择找回方式，下面只需选填其中一项:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'chooseWay')->dropDownList(['1' => '手机','2' => '邮箱'],['prompt' => '请选择']) ?>
    
        <?= $form->field($model, 'user_mail') ?>
    
        <?= $form->field($model, 'user_phone') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('发送', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <?= Html::resetButton('清除', ['class' => 'btn btn-primary', 'name' => 'reset-button'])?>
            </div>
        </div>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>
