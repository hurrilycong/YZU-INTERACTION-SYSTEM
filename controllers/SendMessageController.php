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
            $formModel->student_number = \Yii::$app->user->getId();
            $formModel->isread = 0;
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
                 ->where(['teacher_number' => \Yii::$app->user->getId(),'isread' => 0])
         ]);
         
         return $this->render('unread-message',[
             'dataProvider' => $dataProvider]);
     }
     
     /*
      * 查看已读留言情况
      * 
      */
     public function actionReadedMessage()
     {
         $dataProvider = new \yii\data\ActiveDataProvider([
             'query' => \app\models\CourseMessage::find()
                 ->innerJoin('teacher_course','teacher_course.course_id = course_message.course_id')
                 ->where(['teacher_number' => \Yii::$app->user->getId(),'isread' => 1])
         ]);
         
         return $this->render('readed-message',[
             'dataProvider' => $dataProvider]);
     }
     
     /*
      * 批量删除留言
      * 
      */
     
     public function actionDeleteAll($id)
     {
         $selectionData = \Yii::$app->request->post('selection');
         if($selectionData != NULL)
         {
             //批量删除已读留言
             $this->DeleteRdMg($selectionData,$id);
         }
         $query = \app\models\CourseMessage::find()->innerJoin('teacher_course','teacher_course.course_id = course_message.course_id')
                                             ->where(['teacher_number' => \Yii::$app->user->getId(),'isread' => $id]);
         $dataProvider = new \yii\data\ActiveDataProvider([
             'query' => $query,
             'pagination' =>[
                 'pageSize' => 8,
             ]
         ]);
         
         return $this->render('delete-all',[
             'dataProvider' => $dataProvider,
         ]);
     }
     
     /*
      * 确认删除项
      * 
      */
     protected function DeleteRdMg($selectionData,$id)
     {
         for($i = 0;$i < sizeof($selectionData);$i++)
         {
              $this->verifiedD(\yii\helpers\ArrayHelper::toArray(\json_decode($selectionData[$i]))['message_id'],$id);
         }
     }


     /*
      * 删除留言
      */
     
     public function actionDelete($id)
     {
         $courseMessage = \app\models\CourseMessage::find()->where(['message_id' => $id])->one();
         if($courseMessage->delete())
         {
             return $this->redirect('/teacher/index');
         }
         else
         {
             throw new \yii\web\NotFoundHttpException(json_decode($courseMessage->getErrors()));
         }
         //return $this->render('delete');
     }
     
     /*
      * 回复留言
      */
     
     public function actionAnswer()
     {
         
     }
     
     /*
      * 
      * 查看留言
      */
     public function actionView($id)
     {
         $model = \app\models\CourseMessage::find()->where(['message_id' => $id])->one();
         $model->isread = 1;
         if(!$model->save())
         {
             echo '发生错误';
         }
         return $this->render('view',[
             'model' => $model
         ]);
     }

     /*
      * 批量删除的操作函数
      * 
      */
    public function verifiedD($mid, $id) {
        $messageId = \app\models\CourseMessage::find('message_id')->innerJoin('teacher_course','course_message.course_id = teacher_course.course_id')
                ->where(['message_id' => $mid, 'verified' => $id,'teacher_number' => \Yii::$app->user->getId()])->one();
        $courseMessage = \app\models\CourseMessage::find()->where(['message_id' => $messageId])->one();
        if($courseMessage->delete()){
            return TRUE;
        }
        else
        {
            throw new \yii\web\NotFoundHttpException(\json_decode($courseMessage-getErrors()));
        }
        
    }

}
