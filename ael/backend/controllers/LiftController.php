<?php

namespace backend\controllers;

use Yii;
use app\models\AelLift;
use app\models\AelLiftSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\formats\MailTo;

/**
 * LiftController implements the CRUD actions for AelLift model.
 */
class LiftController extends Controller
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
     * Lists all AelLift models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelLiftSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelLift model.
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
     * Creates a new AelLift model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelLift();
        $model->is_active = '1';
        $modelUserType =  new \app\models\AelUser();
        $userData = $modelUserType->find()->where("user_type='4' AND is_admin != '1' ")->asArray()->all();
       
        if($model->load(Yii::$app->request->post())) {
            $maxData = $model->find()->select('id')->orderBy('id DESC')->asArray()->one(); 
            if(!empty($maxData)) {
                $maxData = $maxData['id'];
            } else {
                $maxData = 0;
            }
            $maxData+=1;
            $qrcodeNumber =  "L000000".$maxData; 
            $generateQRcode = QrCode::png($qrcodeNumber,'../assets/qrcode/'.$qrcodeNumber.'.png');
            $model->lift_qr_code = $qrcodeNumber;
            $model->lift_installation_date = date("Y-m-d",strtotime($_POST['AelLift']['lift_installation_date']));
            
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Lift added successfully');
                return $this->redirect('lift/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'userData' => $userData
            ]);
        }
    }

    /**
     * Updates an existing AelLift model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->lift_installation_date = date("F-d-Y",strtotime($model->lift_installation_date));
        $modelUserType =  new \app\models\AelUser();
        $userData = $modelUserType->find()->where("user_type='4' AND is_admin != '1' ")->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $model->lift_installation_date = date("Y-m-d",strtotime($_POST['AelLift']['lift_installation_date']));
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Lift updated successfully');
                return $this->redirect('lift/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'userData' => $userData
            ]);
        }
    }

    /**
     * Deletes an existing AelLift model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionChangestatus() {
        $id = Yii::$app->request->get('id');
        $status = Yii::$app->request->get('status');
        $model = $this->findModel($id);
        $model->is_active = $status;
        $model->save();
        \Yii::$app->getSession()->setFlash('success', 'Status updated successfully');
        return $this->redirect(['index']);
    }

    /**
     * Finds the AelLift model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelLift the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelLift::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
