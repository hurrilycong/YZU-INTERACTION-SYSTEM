<?php

namespace app\models\Form;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ForgotPasswordForm extends Model
{
//    public $course_id;
    public $user_phone;//暂时不用
    public $user_mail;
    public $chooseWay;//找回方式

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['chooseWay'], 'required','message' => '此项不能为空'],
            //[['user_mail'],'string'],
            //[['user_mail', 'email']],
            //[['user_phone'], 'integer', 'min' => '10000000000','max' => '99999999999', 'message' => '此项不能为空'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'user_mail' => '邮箱',
            'user_phone' => '手机号码',
            'chooseWay' => '找回方式',
        ];
    }
    
}
