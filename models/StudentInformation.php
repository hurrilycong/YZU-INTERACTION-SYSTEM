<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_information".
 *
 * @property integer $student_number
 * @property string $student_class
 *
 * @property User $studentNumber
 */
class StudentInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        /*
            [['student_number', 'student_class','student_major','student_college'], 'required'],
            [['student_number'], 'integer'],
            [['student_class'], 'string', 'max' => 50],
            [['student_major'], 'integer'],
            [['student_college'],'integer'],
            ['student_email','email'],
            [['student_phone'], 'match','pattern' => '/^1[34578]{1}\d{9}$/', 'message' => '手机格式不正确'],*/
            [['student_number', 'student_class', 'student_college', 'student_major'], 'required'],
            [['student_number', 'student_college', 'student_major'], 'integer'],
            [['student_class', 'student_email'], 'string', 'max' => 50],
            [['student_phone'], 'string', 'max' => 11],
            [['student_email'], 'unique','message' => '该邮箱已注册'],
            [['student_phone'], 'unique','message' => '该手机号码已注册'],
            ['student_email','email'],
            [['student_phone'], 'match','pattern' => '/^1[34578]{1}\d{9}$/', 'message' => '手机格式不正确'],
            [['student_college'], 'exist', 'skipOnError' => true, 'targetClass' => College::className(), 'targetAttribute' => ['student_college' => 'cnumber']],
            [['student_major'], 'exist', 'skipOnError' => true, 'targetClass' => Major::className(), 'targetAttribute' => ['student_major' => 'mnumber']],
            [['student_number'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_number' => 'user_number']],
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

    /** 
        * @return \yii\db\ActiveQuery 
    */ 
    public function getCourseMessages() 
    { 
        return $this->hasMany(CourseMessage::className(), ['student_number' => 'student_number']); 
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNumber()
    {
        return $this->hasOne(User::className(), ['user_number' => 'student_number']);
    }
    
    public function getStudentCollege()
    {
        return $this->hasOne(College::className(),['cnumber' => 'student_college']);
    }
    
    public function getStudentMajor()
    {
        return $this->hasOne(Major::className(), ['mnumber' => 'student_major']);
    }
}
