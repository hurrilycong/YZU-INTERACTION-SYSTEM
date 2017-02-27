<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_course".
 *
 * @property integer $course_id
 * @property string $course_name
 * @property string $course_content
 * @property integer $teacher_number
 *
 * @property CourseFile[] $courseFiles
 * @property CourseMessage[] $courseMessages
 * @property CourseMessage[] $courseMessages0
 * @property CourseMessageStudent[] $courseMessageStudents
 * @property CourseNotice[] $courseNotices
 * @property StudentCourse[] $studentCourses
 * @property User[] $studentNumbers
 * @property User $teacherNumber
 * @property TeacherWork[] $teacherWorks
 */
class TeacherCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_name', 'teacher_number'], 'required'],
            [['course_content'], 'string'],
            [['teacher_number'], 'integer'],
            [['course_name'], 'string', 'max' => 255],
            [['teacher_number'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_number' => 'user_number']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'course_name' => 'Course Name',
            'course_content' => 'Course Content',
            'teacher_number' => 'Teacher Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseFiles()
    {
        return $this->hasMany(CourseFile::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseMessages()
    {
        return $this->hasMany(CourseMessage::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * 创建外键时出现的问题
     * 可以不用理会
     */
    public function getCourseMessages0()
    {
        return $this->hasMany(CourseMessage::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseMessageStudents()
    {
        return $this->hasMany(CourseMessageStudent::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseNotices()
    {
        return $this->hasMany(CourseNotice::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentNumbers()
    {
        return $this->hasMany(User::className(), ['user_number' => 'student_number'])->viaTable('student_course', ['course_id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherNumber()
    {
        return $this->hasOne(User::className(), ['user_number' => 'teacher_number']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherWorks()
    {
        return $this->hasMany(TeacherWork::className(), ['course_id' => 'course_id']);
    }
}
