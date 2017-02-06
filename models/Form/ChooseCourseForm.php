<?php

namespace app\models\Form;

use Yii;
use yii\base\Model;
use app\models\Course;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChooseCourseForm extends Model
{
//    public $course_id;
    public $student_class;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['student_class'], 'required', 'message' => '此项不能为空'],
           // [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' =>Course::className(), 'targetAttribute' => ['course_id' => 'course_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_class' => '请选择课程名',
        ];
    }
    
}
