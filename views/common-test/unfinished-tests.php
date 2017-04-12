<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TeacherWork */

$this->title = '未完成测试';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/student-course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-work-view">

    <h1><?= Html::encode($this->title) ?></h1>


     <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            'test_title',
            'test_content',
            'test_score',
            [
                'attribute' => '来自',
                'value' => 'course.course_name'
            ],
            [
                'attribute' => '操作',
                'value' => 'doTestLink',
                'format' => 'raw'
            ]
        ],
    ]); ?>

</div>
