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
 *
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
            [['message_title', 'message_content', 'message_date'], 'required','message' => '此项不能为空'],
            [['message_date'], 'integer'],
            [['message_title'], 'string', 'max' => 50],
            [['message_content'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_title' => '标题',
            'message_content' => '内容',
            'message_date' => '日期',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseMessageStudent()
    {
        return $this->hasOne(CourseMessageStudent::className(), ['message_id' => 'message_id']);
    }
}