<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "major".
 *
 * @property integer $mnumber
 * @property string $mname
 * @property integer $cnumber
 *
 * @property College $cnumber0
 * @property StudentInformation[] $studentInformations
 */
class Major extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'major';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mnumber', 'mname', 'cnumber'], 'required'],
            [['mnumber', 'cnumber'], 'integer'],
            [['mname'], 'string', 'max' => 50],
            [['cnumber'], 'exist', 'skipOnError' => true, 'targetClass' => College::className(), 'targetAttribute' => ['cnumber' => 'cnumber']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mnumber' => 'Mnumber',
            'mname' => 'Mname',
            'cnumber' => 'Cnumber',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnumber0()
    {
        return $this->hasOne(College::className(), ['cnumber' => 'cnumber']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentInformations()
    {
        return $this->hasMany(StudentInformation::className(), ['student_major' => 'mnumber']);
    }
}
