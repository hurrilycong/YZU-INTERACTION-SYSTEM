<?php

namespace app\models\Form;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $userid;
    public $username;
    public $password;
    public $repassword;
    public $isteacher = false;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['userid', 'password', 'username', 'repassword'], 'required', 'message' => '此项不能为空'],
            [['username'], 'string', 'min' => '2', 'max' => '10', 'message' => '姓名至少为两个字符'],
            [['userid'], 'integer','min' => '100000', 'max' => '100000000000', 'message' => '学号不正确'],
            //[['userid'], 'unique', 'targetClass' => '\app\models\User', 'message' => '该用户已注册'],
            [['password', 'repassword'], 'string', 'min' => '6', 'max' => '12', 'message' => '密码应大于6个字符小于12个字符'],
            [['repassword'], 'compare', 'compareAttribute' => 'password', 'message' => '两次密码不相同'],
            [['isteacher'], 'boolean'],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => '学号/工号',
            'username' => '姓名',
            'password' => '密码',
            'repassword' => '重复密码',
            'isteacher' => '注册教师',
        ];
    }
    
}
