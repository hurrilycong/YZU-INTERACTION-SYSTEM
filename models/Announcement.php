<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Announcement extends yii\db\ActiveRecord implements IdentityInterface
{


    public static function tableName() {
        return 'announcement';
    } 
    
    public function rules() {
        return[
            [['announce_id', 'course_id', 'announce_title'], 'required'],
            [['announce_id', 'course_id'], 'integer'],
            [['announce_title'], 'string', 'max' => 255],
        ];
    }
    
    public function attributeLabels() {
        return [
            'announce_id' => '公告ID',
            'course_id' => '课程号',
            'announce_title' => '公告标题',
            'announce_content' => '公告内容',
            'announce_time' => '发布时间',
        ];
    }
    
    public function beforeSave($insert) {
        if (parent::beforeSave($insert))
        {
            if($this->isNewRecord)
            {
                $this->announce_time = \date('Y-m-d H:m:s');
                return TRUE;
            }
        }
        return false;
    }
    
    public function getAnnouncement()
    {
        return $this->hasMany(Announcement::className(), ['course_id' => 'course_id']);
    }
    
    public function getId() {
        return $this->course_id;
    }
    
    public static function findIdentity($id) {
        return static::findOne($id);;
    }
    
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }
    
    public function getAuthKey() {
        ;
    }
    public function validateAuthKey($authKey) {
        ;
    }
}