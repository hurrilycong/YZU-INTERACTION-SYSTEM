<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = '错误';
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        您似乎还未注册，点击
        <?= Html::a('这里', ['site/signup']) ?>
        注册.
    </p>

</div>
