<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_information".
 *
 * @property integer $teacher_number
 * @property integer $teacher_introduction
 */
class TeacherInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_introduction','teacher_college','teacher_number'], 'required','message' => '此项不能为空'],
            [['teacher_introduction'],'string','min' => 5,'max' => 100],
            [['teacher_college'], 'integer'], 
            [['teacher_phone'], 'string', 'max' => 11], 
            [['teacher_email'], 'string', 'max' => 50], 
            ['teacher_email','email'],
            [['teacher_email'],'unique','message' => '该邮箱已注册'],
            [['teacher_phone'], 'match','pattern' => '/^1[34578]{1}\d{9}$/', 'message' => '手机格式不正确'],
            [['teacher_phone'],'unique','message' => '该手机号码已注册'],
            [['teacher_college'], 'exist', 'skipOnError' => true, 'targetClass' => College::className(), 'targetAttribute' => ['teacher_college' => 'cnumber']], 
            [['teacher_number'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_number' => 'user_number']], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_number' => '教师号',
            'teacher_introduction' => '个人简介',
            'teacher_college' => '所属学院',
            'teacher_phone' => '手机号',
            'teacher_email' => '邮箱',
        ];
    }
    
    /** 
	* @return \yii\db\ActiveQuery 
    */ 
    public function getTeacherCollege() 
    { 
	return $this->hasOne(College::className(), ['cnumber' => 'teacher_college']); 
    } 
            
    /** 
        * @return \yii\db\ActiveQuery 
    */ 
    public function getTeacherNumber() 
   { 
       return $this->hasOne(User::className(), ['user_number' => 'teacher_number']); 
   } 
}
