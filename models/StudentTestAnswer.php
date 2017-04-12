<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_test_answer".
 *
 * @property integer $answer_id
 * @property string $answer_content
 * @property string $answer_date
 * @property integer $student_number
 *
 * @property StudentInformation $studentNumber
 */
class StudentTestAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_test_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer_content', 'answer_date', 'student_number'], 'required'],
            [['answer_content'], 'string'],
            [['student_number'], 'integer'],
            [['answer_date'], 'string', 'max' => 255],
            [['student_number'], 'exist', 'skipOnError' => true, 'targetClass' => StudentInformation::className(), 'targetAttribute' => ['student_number' => 'student_number']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'answer_id' => 'Answer ID',
            'answer_content' => '答案',
            'answer_date' => '作答时间',
            'student_number' => '学号',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNumber()
    {
        return $this->hasOne(StudentInformation::className(), ['student_number' => 'student_number']);
    }
}
