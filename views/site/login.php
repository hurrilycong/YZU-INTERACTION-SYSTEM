<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        //'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
            'horizontalCssClasses' => [
            'label' => '',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],

        ],
        
    ]); ?>

        <?= $form->field($model, 'userid')->textInput(['autofocus' => true,]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'verifyCode')->widget(yii\captcha\Captcha::className(),[
            'captchaAction' => '/site/captcha',
            'template' => '<div class="row"><div class="col-lg-5">{input}</div>'
            . '<div class="col-lg-5">{image}</div></div>',
            'imageOptions' => ['alt' => '图片无法加载','title' => '下一张','style' => 'cursor:pointer'],
        ]); ?>
    
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::resetButton('重置', ['class' => 'btn btn-primary', 'name' => 'reset-button'])?>
                <?= Html::a('忘记密码',['forgot-password'])?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
