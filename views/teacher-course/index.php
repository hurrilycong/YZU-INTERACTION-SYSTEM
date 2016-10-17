<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的课程';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建新课程', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('导入班级', ['load-class-student'], ['class' => 'btn btn-primary']) ?> 
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'course_id',
            [
               'attribute'=>'teacherCourseLink', 'format'=>'raw' 
            ],
            [
               'attribute'=>'courseUserCountLink', 'format'=>'raw' 
            ],
            [
               'attribute'=>'courseWaitingLink', 'format'=>'raw' 
            ],
            [
               'attribute'=>'courseWorksLink', 'format'=>'raw' 
            ],
        
        ],
    ]); ?>
</div>
