<?php

namespace app\models\Form;

use Yii;
use app\models\CommonTest;
use app\models\TeacherCourse;
/**
 * This is the model class for table "common_test".
 *
 * @property integer $test_id
 * @property string $test_title
 * @property string $test_content
 * @property string $test_answer
 * @property integer $test_score
 * @property string $dead_line
 * @property integer $course_id
 * @property string $test_date
 *
 * @property TeacherCourse $course
 * @property CommonTestBroadcast[] $commonTestBroadcasts
 * @property StudentInformation[] $studentNumbers
 */
class CommonTestForm extends \yii\base\Model
{
    public $test_id;
    public $test_title;
    public $test_content;
    public $test_answer;
    public $test_score;
    public $dead_line;
    public $course_id;
    public $test_date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_title', 'test_content', 'test_answer', 'test_score'], 'required','message' => '此项不能为空'],
            [['test_content'], 'string', 'min' => 6, 'message' => '必须大于6个字符'],
            [['test_score'], 'integer'],
            [['test_title', 'test_answer'], 'string', 'max' => 255],
            //[['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherCourse::className(), 'targetAttribute' => ['course_id' => 'course_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'test_id' => 'Test ID',
            'test_title' => '测试标题',
            'test_content' => '测试内容',
            'test_answer' => '测试答案',
            'test_score' => '测试总成绩',
            'dead_line' => '截止时间',
            'course_id' => '课程号',
            'test_date' => '发布时间',
        ];
    }
    /*
     * 存储操作，将数据存入数据库中
     * @return User|null the saved model or null if saving fails
     */
    
    public function insertCommonTest($cid)
    {
        //var_dump($this->validate());
        //exit(0);
        if(!$this->validate())
        {
            return false;
        }
        $common = new CommonTest();
        $common->test_title = $this->test_title;
        $common->test_content = $this->test_content;
        $common->test_answer = $this->test_answer;
        $common->test_score = $this->test_score;
        $common->dead_line = Yii::$app->formatter->asDatetime(time(), "php:mhi");
        $common->course_id = $cid;
        $common->test_date = Yii::$app->formatter->asDatetime(time(), "php:mhi");
        
        //var_dump(Yii::$app->formatter->asDatetime(time()));
        //exit(0);
        
        return $common->save()?true:false;
    }
}
