<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = '未读通知';
$this->params['breadcrumbs'][] = ['label' => '我的课程' ,  'url' => ['/student-course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-work-view">
    <h1><?=        Html::encode($this->title) ?></h1>
    <?=    GridView::widget(['dataPrivider' => $dataProvider,
        'columns' => [
            [
                ''
            ]
        ]    
        ]);?>
</div>
