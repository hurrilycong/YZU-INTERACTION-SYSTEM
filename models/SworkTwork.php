<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "swork_twork".
 *
 * @property integer $swork_id
 * @property integer $twork_id
 *
 * @property StudentWork $swork
 * @property TeacherWork $twork
 */
class SworkTwork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'swork_twork';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['swork_id', 'twork_id'], 'required'],
            [['swork_id', 'twork_id'], 'integer'],
            [['swork_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentWork::className(), 'targetAttribute' => ['swork_id' => 'swork_id']],
            [['twork_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherWork::className(), 'targetAttribute' => ['twork_id' => 'twork_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'swork_id' => 'Swork ID',
            'twork_id' => 'Twork ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwork()
    {
        return $this->hasOne(StudentWork::className(), ['swork_id' => 'swork_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTwork()
    {
        return $this->hasOne(TeacherWork::className(), ['twork_id' => 'twork_id']);
    }
}
