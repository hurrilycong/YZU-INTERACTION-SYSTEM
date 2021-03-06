<?php

use yii\helpers\Html;
use yii\grid\GridView;
//
///* @var $this yii\web\View */
///* @var $searchModel app\models\StudentWorkSearch */
///* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的作业列表';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/student-course/index']];
$this->params['breadcrumbs'][] = '全部作业';
?>
<div class="student-work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'tWorkLink', 'format' => 'raw'
            ],
            [
                'attribute' => 'twork_content',
                'value' => 'Beginning',
            ],
//            [
//                'label' => '所属课程',
//                //'value' => $dataProvider->Course->course_name,
//            ],
            'twork_date:date',
            'twork_deadline:date',
             [
               'attribute'=>'commitWorkLink', 'format'=>'raw' 
            ],
        ],
    ]); ?>
    
</div>
