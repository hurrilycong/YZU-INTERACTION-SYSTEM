<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Form\LoginForm;
use app\models\Form\ContactForm;
use app\models\Form\SignupForm;
use app\models\Form\ForgotPasswordForm;
use app\models\User;
use app\models\StudentInformation;
use app\models\teacher\CourseWithTeacher;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','login'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x000000,
                'maxLength' => 6,
                'minLength' => 5,
                'padding' => 5,
                'height' => 40,
                'width' => 130,
                'foreColor' => 0xffffff,
                'offset' => 4,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   
        $courses = CourseWithTeacher::find()->all();
        return $this->render('index',[
            'courses' => $courses
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
            //return $this->renderPartial('//user/index');//登陆成功后，重定向到user试图文件夹下的index，参数问题
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //重复注册问题的代码设计暂缺
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $user = new User();
                $student = new StudentInformation();
                $user->user_number = $model->userid;
                $user->user_name = $model->username;
                $user->user_password = $model->password;
                $student->student_number = $model->userid;
                $user->save();
                $student->save();//将学号写入学生信息表
                $transaction->commit();
            }
            catch (Exception $ex) {
                    $transaction->rollBack();
            }       
            //设置角色
            if($model->isteacher == TRUE){
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('nochecked_teacher');
                $auth->assign($userRole, $user->user_number);
                $identity = User::findOne($user->user_number);
                Yii::$app->user->login($identity, 0);
                return $this->redirect(['/teacher/update-user']);
            }else{
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('student');
                $auth->assign($userRole, $user->user_number);
                $identity = User::findOne($user->user_number);
                Yii::$app->user->login($identity, 0);
                //跳转到学生信息完善
                return $this->redirect(['/student/update-user']);
            }
            Yii::$app->session->setFlash('success', "注册成功");
            return $this->goBack();
        }       
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionForgotPassword()
    {
        $model = new ForgotPasswordForm();
        if ($model->load(Yii::$app->request->post())) {
            //Yii::$app->session->setFlash('contactFormSubmitted');
            if($model->chooseWay == 1)
            {
                //选择手机发送的逻辑
                //验证码核对成功后进入修改密码界面
                    return $this->render('in-phone',['model' => $model]);
            }
            else if($model->chooseWay == 2)
            {
                //选择邮箱发送的逻辑
                return $this->render('in-email',['model' => $model]);
            }
        }
        return $this->render('forgot-password',['model' => $model]);
    }
    public function actionErrorUnregister()
    {
        return $this->render('error-unregister');
    }
}
