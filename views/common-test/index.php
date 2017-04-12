<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherWorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->course_name.'的课堂测试列表';
$this->params['breadcrumbs'][] = ['label' => '我的课程', 'url' => ['/teacher-course/index']];
//$this->params['breadcrumbs'][] = ['label' => $course->course_name, 'url' => ['teacher-course/course', 'cid' => $course->course_id]];
$this->params['breadcrumbs'][] = '全部课堂测试列表';
?>
<div class="teacher-work-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?=        Html::a('创建新测试',['create', 'cid' => $model->course_id], ['class' => 'btn btn-primary']); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '编号'],
            'test_title',
            'test_content',
            'test_answer',
            'test_score',
            'dead_line:date',
            'test_date:date',
            [
                'class' => 'yii\grid\ActionColumn','header' => '操作',
                'template' => '{view}{delete}',
            ],
        ],
    ]); ?>
    
</div>
