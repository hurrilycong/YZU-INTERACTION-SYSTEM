<?php

namespace app\models\Form;

use app\models\User;
use yii\base\Model;
use yii\helpers\VarDumper;
/* 
 * 这是重置密码的模型
 */

class ResetPasswordForm extends Model
{
    public $password_before;
    public $password;
    public $password_repeat;
    
    /*
     * 验证规则，密码和重复密码需相同
     */
    public function rules() {
        return [
          [['password', 'password_repeat','password_before'], 'required', 'message' => '此项不能为空'],
          [['password'], 'string', 'min' => 6],
          [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => '两次密码不相同'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'password' => '密码',
            'password_repeat' => '重复密码',
            'password_before' => '原密码'
        ];
    }
    
    public function checkOldPwd($oldPwd,$id)
    {
        $user = new \app\models\UserSearch();
        $password = $user->search('user_password',['user_id' => $id]);
    }


    public function resetPwd($id)
    {
        if(!$this->validate())
        {
            return null;
        }
        //$user = User::findOne($id);
        //VarDumper::dump($user);
        //$user->setPassword($this->password);
        //VarDumper::dump($user);        exit(0);
        //VarDumper::dump($user->save() ? TRUE :false);        exit(0);
        //return $user->save() ? true :false;
        $count = User::updateAll(['user_password' => \md5($this->password)], ['user_number' => $id]);
        //var_dump($count);
        //exit(0);
        if ($count > 0) {
            return 1;
        }
        else if($count == 0) {
            return 0;
        }
        else
        {
            return -1;
        }
    }
}

