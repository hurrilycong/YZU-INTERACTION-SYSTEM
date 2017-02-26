<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course_message_student".
 *
 * @property integer $message_id
 * @property integer $student_number
 * @property integer $course_id
 *
 * @property CourseMessage $message
 * @property User $studentNumber
 * @property TeacherCourse $course
 */
class CourseMessageStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_message_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_id', 'student_number', 'course_id'], 'required','message' => '此项不能为空'],
            [['message_id', 'student_number', 'course_id'], 'integer'],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => CourseMessage::className(), 'targetAttribute' => ['message_id' => 'message_id']],
            [['student_number'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_number' => 'user_number']],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherCourse::className(), 'targetAttribute' => ['course_id' => 'course_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => '留言ID',
            'student_number' => '学号',
            'course_id' => '课程',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(CourseMessage::className(), ['message_id' => 'message_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNumber()
    {
        return $this->hasOne(User::className(), ['user_number' => 'student_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(TeacherCourse::className(), ['course_id' => 'course_id']);
    }
}
