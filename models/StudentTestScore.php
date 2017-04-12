<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_test_score".
 *
 * @property integer $test_id
 * @property integer $answer_id
 * @property integer $score
 */
class StudentTestScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_test_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'answer_id', 'score'], 'required'],
            [['test_id', 'answer_id', 'score'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'test_id' => 'Test ID',
            'answer_id' => 'Answer ID',
            'score' => 'Score',
        ];
    }
}
