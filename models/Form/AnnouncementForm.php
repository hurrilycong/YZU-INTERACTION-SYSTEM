<?php

namespace app\models;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Yii;

class Announcement extends \yii\db\ActiveRecord
{
    public $announce_id;
    public $course_id;
    public $announce_title;
    public $announce_content;
    public $announce_time;
    
    public static function tableName()
    {
            return 'announcement';
    }
    
    public function rules() {
        return [
            [['course_id','announce_title', 'announce_content'], 'required'],
            [['course_id'], 'integer' ],
            [['announce_title'], 'string'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'course_id' => '课程号',
            'announce_tilte' => '标题',
            'announce_content' => '内容',
        ];
    }
}

