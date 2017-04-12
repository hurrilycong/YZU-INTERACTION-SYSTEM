<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentWork */

$this->title = '完成测试';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-center-view">

    <h1><?= Html::encode($this->title) ?></h1>
        <?= DetailView::widget([
            'model' => $test,
            'attributes' => [
            'test_content',
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
        
        <?= $form->field($model, 'answer_content')?>
        
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
            
            <?=            Html::submitButton('确认', ['class' => 'btn btn-primary'])?>
            <?=            Html::resetButton('取消', ['/student/index'], ['class' => 'btn btn-primary', 'name' => 'reset-button'])?>
            </div>
        </div>
        <?php        ActiveForm::end(); ?>
    </div>
    
</div>
