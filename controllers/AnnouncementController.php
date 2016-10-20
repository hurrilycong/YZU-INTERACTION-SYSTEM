<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Form\AnnouncementForm;

class AnnouncementController extends Controller
{
    public function actionIndex()
    {
        $model = new AnnouncementForm();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $announcement = new \app\models\Announcement();
            $announcement->course_id = $model->course_id;
            $announcement->announce_title = $model->announce_title;
            $announcement->announce_content = $model->announce_content;
            $announcement->announce_time = $model->announce_time;
            $announcement->save();
        }
        Yii::$app->session->setFlash('success', '公告已完成');
        return $this->render('index', ['model' => $model]);
    }
}
