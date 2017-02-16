<?php

namespace app\models\Form;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * 学生信息填写表格model
 *
 */
class AddStuInfoForm extends Model
{
    public $student_class;
    public $student_number;
    public $student_major;
    public $student_college;
    public $student_email;
    public $student_phone;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['student_class', 'student_number','student_major','student_college'], 'required', 'message' => '此项不能为空'],
            [['student_number'], 'integer'],
            [['student_class'], 'string', 'max' => 50],
            [['student_major'], 'integer'],
            [['student_college'],'integer'],
            ['student_email','email'],
            [['student_phone'], 'match','pattern' => '/^1[34578]{1}\d{9}$/', 'message' => '手机格式不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_number' => '学号',
            'student_class' => '班级',
            'student_college' => '所属学院',
            'student_major' => '所属专业',
            'student_email' => '邮箱',
            'student_phone' => '手机号',
        ];
    }
    
}
