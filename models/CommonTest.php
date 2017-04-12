<?php

namespace app\models;


use app\models\TeacherCourse;
use app\models\CommonTestBroadcast;
use app\models\StudentInformation;
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
class CommonTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'common_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_title', 'test_content', 'test_answer', 'test_score', 'dead_line', 'course_id', 'test_date'], 'required'],
            [['test_content'], 'string'],
            [['test_score', 'course_id'], 'integer'],
            [['test_title', 'test_answer', 'dead_line', 'test_date'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherCourse::className(), 'targetAttribute' => ['course_id' => 'course_id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(TeacherCourse::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommonTestBroadcasts()
    {
        return $this->hasMany(CommonTestBroadcast::className(), ['test_id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNumbers()
    {
        return $this->hasMany(StudentInformation::className(), ['student_number' => 'student_number'])->viaTable('common_test_broadcast', ['test_id' => 'test_id']);
    }
    
    /*
     * 链接到作业界面
     */
    
    public function getDoTestLink()
    {
        $url = \yii\helpers\Url::to(['do-test','id' => $this->test_id]);
        $option = [];
        return \yii\helpers\Html::a('提交', $url, $option);
    }
}
