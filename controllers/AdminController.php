<?php
namespace app\controllers;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends yii\web\Controller
{
    /*
     * 显示管理员，即教务与团委的界面
     */
    public function actionIndex()
    {
        $model = $this->findUserModel(\Yii::$app->user->getId());
        
        return $this->render('index',[
            'model' => $model,
        ]);
    }
    
    
    /**
     * 找到当前的管理员信息
     * @return $model
     * @throws NotFoundHttpException
     */

    protected function findUserModel(){
        $model= User::find()->where(['user_number' => Yii::$app->user->getId()])->one();
        if($model != null){
            return $model;
        }
        throw new NotFoundHttpException('错误操作！');
    }
}
