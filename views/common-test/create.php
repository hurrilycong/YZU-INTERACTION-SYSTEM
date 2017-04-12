<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CommonTest */

$this->title = '创建新测试';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/teacher-course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
