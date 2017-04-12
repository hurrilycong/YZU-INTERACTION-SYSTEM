<?php

namespace app\models\Form;

use app\models\StudentTestAnswer;
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
class StudentTestAnswerForm extends \yii\base\Model
{
    public $answer_content;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer_content'], 'required','message' => '此项不能为空'],
            [['answer_content'], 'string'],
            //[['student_number'], 'exist', 'skipOnError' => true, 'targetClass' => StudentInformation::className(), 'targetAttribute' => ['student_number' => 'student_number']],
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
    
    /*
     * 插入到数据库
     * 
     */
    public function insertDB()
    {
        if(!$this->validate())
        {
            return false;
        }
        $model = new StudentTestAnswer();
        $model->answer_content = $this->answer_content;
        $model->answer_date = time();
        $model->student_number = \Yii::$app->user->getId();
        
        return $model->save()?true:false;
    }
}
