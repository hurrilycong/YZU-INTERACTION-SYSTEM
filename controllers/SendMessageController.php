<?php

namespace app\controllers;


class SendMessageController extends \yii\web\Controller
{
    /*
     * 创建留言的action
     */
    
    public function actionIndex()
    {
        $model = new \app\models\Form\CourseMessageForm();
        
        if($model->load(\Yii::$app->request->post()) && $model->validate())
        {
            $formModel = new \app\models\CourseMessage();
            $formModel->message_title = $model->message_title;
            $formModel->message_content = $model->message_content;
            $formModel->message_date = time();
            $formModel->course_id = $model->course_id;
            $formModel->save();
            
            return $this->redirect(['student/index']);
        }
        
        return $this->render('index',['model' => $model]);
    }
    
        /*
     * 查看教师课程的留言情况
     * 
     */

     public function actionUnreadMessage()
     {
         $dataProvider = new \yii\data\ActiveDataProvider([
             'query' => \app\models\CourseMessage::find()
                 ->innerJoin('teacher_course','teacher_course.course_id = course_message.course_id')
                 ->where(['teacher_number' => \Yii::$app->user->getId()])
         ]);
         
         return $this->render('unread-message',['dataProvider' => $dataProvider]);
     }
     
}
