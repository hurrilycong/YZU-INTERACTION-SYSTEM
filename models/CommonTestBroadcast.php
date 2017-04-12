<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "common_test_broadcast".
 *
 * @property integer $test_id
 * @property integer $student_number
 * @property integer $isread
 *
 * @property StudentInformation $studentNumber
 * @property CommonTest $test
 */
class CommonTestBroadcast extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'common_test_broadcast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'student_number'], 'required'],
            [['test_id', 'student_number', 'isread'], 'integer'],
            [['student_number'], 'exist', 'skipOnError' => true, 'targetClass' => StudentInformation::className(), 'targetAttribute' => ['student_number' => 'student_number']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommonTest::className(), 'targetAttribute' => ['test_id' => 'test_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'test_id' => 'Test ID',
            'student_number' => 'Student Number',
            'isread' => 'Isread',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNumber()
    {
        return $this->hasOne(StudentInformation::className(), ['student_number' => 'student_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(CommonTest::className(), ['test_id' => 'test_id']);
    }
}
