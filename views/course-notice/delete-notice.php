<?php

use yii\helpers\Html;
use yii\widgets\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = '删除通知';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/teacher-course/index']];
$this->params['breadcrumbs'][] = ['label' =>  $model->course_name, 'url' => ['/teacher-course/course', 'cid' => $model->course_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
