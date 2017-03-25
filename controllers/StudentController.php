<?php

namespace app\controllers;

use app\models\User;
use app\models\StudentInformation;
use Yii;
use yii\web\NotFoundHttpException;
use app\models\Form\ResetpasswordForm;

class StudentController extends \yii\web\Controller
{
    /**
     * 显示学生资料
     * @return mixed
     */
    public function actionIndex()
    {
        $model = $this->findUserModel(Yii::$app->user->getId());
        
        return $this->render('index',[
            'model' => $model,
        ]);
    }
    
     /**
     * 完善学生信息
     * @return mixd
     */
    public function actionUpdateUser()
    {
        $user = $this->findUserModel(Yii::$app->user->getId());
        $model = $this->findStudentinfoModel(Yii::$app->user->getId());
        if($model == null){
           $model = new StudentInformation();
           $model->student_number = Yii::$app->user->getId();
        }
        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success', "资料更新成功");
            $this->goback();
        }
        return $this->render('update-user', [
            'model' => $model,
            'user' => $user,
        ]);
    }
    
    /*
     * 重置密码功能
     */
    public function actionResetPassword()
    {
        $model = new ResetpasswordForm();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->resetPwd(Yii::$app->user->getId()) === 1 )
            {
                //修改成功直接转到主页，不需设置提示信息
                //\Yii::$app->getSession()->setFlash('success','密码修改成功');
                Yii::$app->user->logout();
                return $this->goHome();
            }
            else if($model->resetPwd(Yii::$app->user->getId()) === 0) {
                \Yii::$app->getSession()->setFlash('warning', '新密码与原密码相同');
            }
            else{
                \Yii::$app->getSession()->setFlash('error', '密码修改失败,原密码不正确');
            }
        }
        return $this->render('reset-password', ['model' => $model]);
    }

    /**
     * 找到当前用户的用户表信息
     * @return $model
     * @throws NotFoundHttpException
     */
    protected function findUserModel(){
        $model= User::find()->where(['user_number' => Yii::$app->user->getId()])->one();
        if($model != null){
            return $model;
        }
        throw new NotFoundHttpException('错误操作！1');
    }
    
    /**
     * 找到当前用户的学生信息表信息
     * @return $model
     * @throws NotFoundHttpException
     */
    protected function findStudentinfoModel(){
        $model= StudentInformation::find()->where(['student_number' => Yii::$app->user->getId()])->one(); 
        return $model;
    }

}
