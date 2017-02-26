<?php

namespace app\controllers;



class SendMessageController extends \yii\web\Controller
{
    /**
     * 选择课程，为创建留言做准备
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new \app\models\Form\ChooseCourseForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            return $this->actionCreate($model->student_class);
        }
        return $this->render('index',['model' => $model]);
    }
    
    /*
     * 创建留言的action
     */
    
    public function actionCreate($courseID)
    {
        $model = new \app\models\CourseMessage();
        
        if($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            
        }
        
        return $this->render('create',['$model' => $model]);
    }
}
