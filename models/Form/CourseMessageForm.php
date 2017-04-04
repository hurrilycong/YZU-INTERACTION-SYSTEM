<?php

namespace app\models\Form;

use Yii;
use yii\base\Model;
use app\models\TeacherCourse;

/**
 * CourseMessageForm is the model behind the course_message form.
 *
 * @property 
 *
 */
class CourseMessageForm extends Model
{
    public $message_title;
    public $message_content;
    public $message_date;
    public $course_id;
    public $isread;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['message_title', 'message_content','course_id'], 'required', 'message' => '此项不能为空'],
            [['course_id','isread'], 'integer'],
            [['message_title'], 'string','min' => 2, 'max' => 255],
            [['message_content'], 'string', 'max' => 20000],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherCourse::className(), 'targetAttribute' => ['course_id' => 'course_id']],
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
            'course_id' => '课程'
        ];
    }
    
}
