<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "college".
 *
 * @property integer $cnumber
 * @property string $cname
 *
 * @property Major[] $majors
 * @property StudentInformation[] $studentInformations
 */
class College extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'college';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cnumber', 'cname'], 'required'],
            [['cnumber'], 'integer'],
            [['cname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cnumber' => 'Cnumber',
            'cname' => 'Cname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajors()
    {
        return $this->hasMany(Major::className(), ['cnumber' => 'cnumber']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentInformations()
    {
        return $this->hasMany(StudentInformation::className(), ['student_college' => 'cnumber']);
    }
}
