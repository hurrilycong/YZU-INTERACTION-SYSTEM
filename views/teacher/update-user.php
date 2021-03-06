<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use Yii;
use yii\bootstrap\Alert;

$this->title = '教师信息更新';
$this->params['breadcrumbs'][] = ['label' =>  '个人中心', 'url' => ['/teacher/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php /*
<?php
    if( Yii::$app->getSession()->hasFlash('success') ) {
	echo Alert::widget([
		'options' => [
			'class' => 'update-user', //这里是提示框的class
		],
		'body' => Yii::$app->getSession()->getFlash('success'), //消息体
	]);
    }
?>*/?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

   <p>
        <?= Html::a('修改密码'  , ['reset-password'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'user_number',
            'user_name',
        ],
    ]) ?>
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    
        <?= $form->field($model, 'teacher_introduction')->textInput() ?>
    
         <?php
            $allStatus = app\models\College::find()
                                        ->select(['cname','cnumber'])
                                        // ->orderBy('position')
                                        ->indexBy('cnumber')
                                        ->column()
        ?>
        <?= $form->field($model, 'teacher_college')->dropDownList($allStatus, ['prompt' => '请选择状态']);?>

        <?= $form->field($model, 'teacher_email') ?>
    
        <?= $form->field($model, 'teacher_phone') ?>
    
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <?=                 Html::a('返回', ['index'], ['class' => 'btn btn-primary']) ?>
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
