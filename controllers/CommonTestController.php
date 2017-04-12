<?php

namespace app\controllers;

use Exception;
use yii\web\NotFoundHttpException;

class CommonTestController extends \yii\web\Controller
{
    /**
     * 显示课堂测试内容
     * @return mixed
     */
    public function actionIndex($cid)
    {
        $model = $this->findModelById($cid);
        $query = \app\models\CommonTest::find()->where(['course_id' => $cid]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8],
        ]);
        return $this->render('index',[
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /*
     * 创建课堂测试
     * @return mixed
     * 
     */
    public function actionCreate($cid)
    {
        $model = new \app\models\Form\CommonTestForm();
        if($model->load(\Yii::$app->request->post()))
        {
            if($model->insertCommonTest($cid))
            {
                return $this->redirect(['index',
                    'cid' => $cid
                ]);
            }
            else
            {
                //var_dump($model->getErrors());
                //exit(0);
                throw new Exception("发生未知错误!!!请重试。");
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /*
     * 查看课堂测试
     * 
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findTestModel($id),
        ]);
    }
    
    /*
     * 删除测试
     * 此动作没有视图
     * 
     */
    public function actionDelete($id)
    {
        $model = $this->findTestModel($id);
        if($model->delete())
        {
            return $this->redirect(['/teacher-course/index']);
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * 推送通知
     * 此动作没有视图
     * 
     */
    public function actionBoardcast($id)
    {
        $model = $this->findTestModel($id);
        $student = \app\models\StudentCourse::find('student_number')->where(['course_id' => $model->course_id, 'verified' => 1])
                ->all();
        $array = \yii\helpers\ArrayHelper::toArray($student);
        //var_dump($array[1]['student_number']);
        //exit(0);
        for ($i = 0;$i < sizeof($array);$i++) {
            $board = new \app\models\CommonTestBroadcast();
            $board->test_id = $id;
            $board->student_number = $array[$i]['student_number'];
            $board->isread = 0;
            if(!$board->save())
            {
                //var_dump($board->student_number);
                //exit(0);
                //此处内置数据有错误，StudentInformation中没有User表中的部分学号导致插入不成功
                //应修改原始数据
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /*
     * 跟据课程号返回教师课程表的对象
     * 
     */
    protected function findModelById($cid)
    {
        if($cid != NULL)
        {
            $model = \app\models\TeacherCourse::find()->where(['course_id' => $cid])->one();
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * 跟据测试ID返回common_test的对象
     * 
     */
    protected function findTestModel($id)
    {
        if($id != NULL)
        {
            $model = \app\models\CommonTest::find()->where(['test_id' => $id])->one();
            return $model;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * 跟据ID 返回student_test_answer的对象
     * 
     */
    public function findAnswerModel($id)
    {
        if($id != NULL)
        {
            $model = \app\models\StudentTestAnswer::find()->where(['answer_id' => $id])->one();
            return $model;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //以下为学生方面的方法
    
    /*
     * 未完成测试列表
     * 
     */
    public function actionUnfinishedTests()
    {
        $tests = \app\models\CommonTest::find()->innerJoin(['common_test_broadcast','common_test.test_id = common_test_boardcast.test_id'])
                ->where(['isread' => 0, 'student_number' => \Yii::$app->user->getId()]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $tests
        ]);
        return $this->render('unfinished-tests', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /*
     * 完成测试答案
     * 
     */
    
    public function actionDoTest($id)
    {
        $test = $this->findTestModel($id);
        
        $model = new \app\models\Form\StudentTestAnswerForm();
        if($model->load(\Yii::$app->request->post() && $model->insertDB()))
        {
            if($this->Calc($model->answer_id, $id))
            {
                //显示提交完成,返回到测试主页
                return $this->redirect(['unfinished-test']);
            }
            else
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            //return $this->redirect(['calc','tid' => $model->answer_id,'id' => $id]);
        }
        
        return $this->render('do-test',[
            'model' => $model,
            'test' => $test,
        ]);
    }
    
    /*
     * 计算正确性
     * 暂未考虑在规定时间内
     * 
     */
    
    public function Calc($tid, $id)
    {
        $model = new \app\models\StudentTestScore();
        
        $answer = $this->findAnswerModel($tid);
        
        $test = $this->findTestModel($id);
        
        $count = 0;
        
        //验证答案的逻辑
        $model->test_id = $tid;
        $model->answer_id = $id;
        $standard = \yii\helpers\ArrayHelper::toArray($test->test_answer);
        $studentAnswer = \yii\helpers\ArrayHelper::toArray($answer->answer_content);
        
        for($i = 0;$i < sizeof($standard);$i++)
        {
            if($standard[i] == $studentAnswer[i])
            {
                $count++;
            }
        }
        
        $model->score = $test->test_score*$count/ \sizeof($standard);
        
        return $model->save()?true:false;
        
        
    }
}
