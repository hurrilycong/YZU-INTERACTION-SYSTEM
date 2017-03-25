<?php
//未使用
namespace app\models\Form;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\base\Model;

class AddTeaInfoForm extends Model
{
    public $teacher_number;
    public $teacher_introduction;
    public $teacher_college;
    public $teacher_email;
    public $teacher_phone;
    
    public function rules()
    {
        return [
            [['teacher_introduction', 'teacher_number','teacher_college'], 'required', 'message' => '此项不能为空'],
            [['teacher_number'], 'integer'],
            [['teacher_introduction'],'string','max' => '50'],
            [['teacher_college'],'integer'],
            ['teacher_email','email'],
            [['teacher_phone'], 'match','pattern' => '/^1[34578]{1}\d{9}$/', 'message' => '手机格式不正确'],
        ];
    }
    
    public function attributeLabels() {
        parent::attributeLabels();
        
        return [
            'teacher_number' => '工号',
            'teacher_introduction' => '自我介绍',
            'teacher_college' => '所属学院',
            'teacher_email' => '邮箱',
            'teacher_phone' => '手机号码'
        ];
    }
}

