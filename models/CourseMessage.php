<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course_message".
 *
 * @property integer $message_id
 * @property string $message_title
 * @property string $message_content
 * @property integer $message_date
 * @property integer $$course_id
 * @property integer $isread 
 * @property CourseMessageStudent $courseMessageStudent
 */
class CourseMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_title', 'message_content', 'message_date','course_id','student_number'], 'required','message' => '此项不能为空'],
            [['message_date', 'course_id','student_number','isread'], 'integer'],
            [['message_title'], 'string', 'max' => 50],
            [['message_content'], 'string', 'max' => 1000],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherCourse::className(), 'targetAttribute' => ['course_id' => 'course_id']], 
            [['student_number'], 'exist', 'skipOnError' => true, 'targetClass' => StudentInformation::className(), 'targetAttribute' => ['student_number' => 'student_number']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'message_id' => '消息ID',
            'message_title' => '标题',
            'message_content' => '内容',
            'message_date' => '日期',
            'course_id' => '课程',
            'student_number' => '来自'
        ];
    }

    public function getCourse() 
    { 
        return $this->hasOne(TeacherCourse::className(), ['course_id' => 'course_id']); 
    } 
    /**
     * @return \yii\db\ActiveQuery
     * 此函数停止使用
     */
    public function getCourseMessageStudent()
    {
        return $this->hasOne(CourseMessageStudent::className(), ['message_id' => 'message_id']);
    }
    
     /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudentNumber()
   {
       return $this->hasOne(StudentInformation::className(), ['student_number' => 'student_number']);
   }
   
   /*
    * 返回有几条未读留言
    * 
    */
   public static function getPendingMessageCount()
   {
       return CourseMessage::find()->innerJoin('teacher_course','course_message.course_id = teacher_course.course_id')
                                    ->where(['isread' => 0,'teacher_course.teacher_number' => Yii::$app->user->getId()])
                                    ->count();
   }
}
