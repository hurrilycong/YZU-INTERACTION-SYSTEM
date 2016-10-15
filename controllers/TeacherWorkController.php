<?php

namespace app\controllers;

use Yii;
use app\models\TeacherWork;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \app\models\Form\TWorkForm;
use \app\models\StudentWork;
use \app\models\Form\TWorkCommentForm;
use \app\models\SworkTwork;
use app\models\Course;

/**
 * TeacherWorkController implements the CRUD actions for TeacherWork model.
 */
class TeacherWorkController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                //非登陆用户无法进入个人中心
                'rules' => [
                     [
                        'allow' => 'true',
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['teacher'],
                    ],
                ]
            ],
        ];
    }

    /**
     * 显示cid课程号对应的作业列表
     * @return mixed
     */
    public function actionIndex($cid)
    {
        //$searchModel = new TeacherWorkSearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = TeacherWork::find()->where(['course_id' => $cid]);
        $course = Course::findOne($cid);
         $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);

        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'course' => $course,
        ]);
    }

    /**
     * Displays a single TeacherWork model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * 依据课程id创建作业
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cid)
    {
        $model = new TWorkForm();
        $model->setCourseName($cid);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $teacherWork = new TeacherWork();
            if(!$teacherWork->isBelongToTeacher(Yii::$app->user->getId())){
              throw new NotFoundHttpException('非法请求');
            }
            $teacherWork->twork_title = $model->title;
            $teacherWork->twork_content = $model->content;
            $teacherWork->twork_date = time();
            $teacherWork->course_id = $cid;
            if(!$teacherWork->save())
            {
                throw new NotFoundHttpException(Yii::trace($teacherWork->getErrors()));
            }
            
            return $this->redirect(['view', 'id' => $teacherWork->twork_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TeacherWork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $formModel = new TWorkForm();
        $formModel->title = $model->twork_title;
        $formModel->content = $model->twork_content;
        if ($formModel->load(Yii::$app->request->post()) && $formModel->validate()) {
            $model->twork_title = $formModel->title;
            $model->twork_content =  $formModel->content;
            $model->twork_update = time();
            $model->save();
            return $this->redirect(['view', 'id' => $model->twork_id]);
        } else {
            return $this->render('update', [
                'model' => $formModel,
                //TODO:显示更新时间未完成
                'lastupdate' => $model->twork_update,
            ]);
        }
    }
    /**
     * 得到某个作业的提交用户列表
     * @param integer $id 老师布置的作业ID
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionSubmitUsers($id = -1)
    {
        if($id == -1){
            throw new NotFoundHttpException('错误请求！');
        }
        $model = StudentWork::find()->innerJoin('swork_twork', 'student_work.swork_id = swork_twork.swork_id')
                                    ->where(['swork_twork.twork_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
         return $this->render('submit-users', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * 作业批改页面
     * @param integer $sworkid 学生做的作业的id
     * @param intger $tworkid 老师布置的作业id
     * @return $mixed
     */
    
    public function actionCommentSwork($sworkid)
    {
        $model = new TWorkCommentForm();
        $studentmodel = StudentWork::findOne($sworkid);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sworkTwork = SworkTwork::findOne($sworkid);
            $sworkTwork->swork_comment = $model->comment; 
            $sworkTwork->swork_grade = $model->grade;
            $sworkTwork->swork_id = $sworkid;
            $sworkTwork->swork_comment_date = time();
            if($sworkTwork->save())
            {
                return $this->redirect(['submit-users', 'id' => $sworkTwork->twork_id]);
            }else{
                Yii::trace($sworkTwork->getErrors(), 'saveError');
                Yii::$app->session->setFlash('error', '提交错误');
            }
        }
            return $this->render('comment-swork', [
                'model' => $model,
                'studentmodel' => $studentmodel,
            ]);
    }

    /**
     * Deletes an existing TeacherWork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeacherWork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeacherWork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeacherWork::find($id)->innerJoin('teacher_course', 'teacher_course.course_id = teacher_work.course_id')
                ->where(['teacher_number' => Yii::$app->user->getId()])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}