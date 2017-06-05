<?php

namespace backend\controllers;

use Yii;
use app\models\AelLeave;
use app\models\AelLeaveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeaveController implements the CRUD actions for AelLeave model.
 */
class LeaveController extends Controller
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
        ];
    }

    /**
     * Lists all AelLeave models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelLeaveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelLeave model.
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
     * Creates a new AelLeave model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelLeave();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AelLeave model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUser = new \app\models\AelUser();
        $userData = $modelUser->find()->select('first_name as label,id')->where("user_type='1' OR user_type='2' OR user_type='3'")->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                $model->leave_start_date =  date("Y-m-d",strtotime($_POST['AelLeave']['leave_start_date'])); 
                $model->leave_start_time =  date("H:i:s",strtotime($_POST['AelLeave']['leave_start_date'])); 
                $model->leave_end_date =  date("Y-m-d",strtotime($_POST['AelLeave']['leave_end_date'])); 
                $model->leave_end_time =  date("H:i:s",strtotime($_POST['AelLeave']['leave_end_date'])); 
                $model->save();
                return $this->redirect('leave');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'userData'=>$userData
            ]);
        }
    }

    /**
     * Deletes an existing AelLeave model.
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
     * Finds the AelLeave model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelLeave the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelLeave::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
