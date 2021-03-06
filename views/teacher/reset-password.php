<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use Yii;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = '重置密码';
$this->params['breadcrumbs'][] = ['label' => '教师信息更新',  'url' => ['update-user']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    //修改成功的提示无用
    if( Yii::$app->getSession()->hasFlash('success') ) {
	echo Alert::widget([
		'options' => [
			'class' => 'reser-password', //这里是提示框的class
		],
		'body' => Yii::$app->getSession()->getFlash('success'), //消息体
	]);
    }
    if(Yii::$app->getSession()->hasFlash('warning')) {
        echo Alert::widget([
            'options' => [
                'class' => 'reset-password',
            ],
            'body' => Yii::$app->getSession()->getFlash('warning'),
        ]);
    }
    if( Yii::$app->getSession()->hasFlash('error') ) {
	echo Alert::widget([
		'options' => [
			'class' => 'reset-password',
		],
		'body' => Yii::$app->getSession()->getFlash('error'),
	]);
    }
?>
<div class="user-create">
    
    <h1><?=        Html::encode($this->title) ?></h1>
    
    <div class="user-form">
        
        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->field($model, 'password_before')->passwordInput()?>
        
        <?= $form->field($model, 'password')->passwordInput()?>
        
        <?= $form->field($model, 'password_repeat')->passwordInput()?>
        
        <div class="form-group">
            
            <?=            Html::submitButton('重置', ['class' => 'btn btn-success'])?>
            <?=            Html::a('返回', ['update-user'],['class' => 'btn btn-success']) ?>
        </div>
        
        <?php        ActiveForm::end(); ?>
    </div>
</div>
