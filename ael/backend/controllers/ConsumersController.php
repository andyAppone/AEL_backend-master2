<?php

namespace backend\controllers;

use Yii;
use app\models\AelConsumers;
use app\models\AelConsumersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Model;
use yii\helpers\Html;
use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\formats\MailTo;

/**
 * UserController implements the CRUD actions for AelUser model.
 */
class ConsumersController extends Controller
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
     * Lists all AelUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelConsumersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelUser model.
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
     * Creates a new AelUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelConsumers();
        $model->is_active = '1';
        $model->scenario = 'create';
        $modelUserType =  new \app\models\AelUserType();
        if ($model->load(Yii::$app->request->post())) {
            $maxData = $model->find()->select('id')->orderBy('id DESC')->asArray()->one(); 
            if(!empty($maxData)) {
                $maxData = $maxData['id'];
            } else {
                $maxData = 0;
            }
            $maxData+=1;
            $qrcodeNumber =  "AC000000".$maxData; 
            $generateQRcode = QrCode::png($qrcodeNumber,'../assets/qrcode/'.$qrcodeNumber.'.png');
            $model->qr_code = $qrcodeNumber;
            
            $model->password = md5($_POST['AelConsumers']['password']);
            $passwordHash = Yii::$app->security->generatePasswordHash($_POST['AelConsumers']['password']);
            $model->password_hash = $passwordHash;
            $authKey = Yii::$app->security->generateRandomString();
            $model->auth_key = $authKey;
            $model->user_type = 4;
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Consumer added successfully');
                return $this->redirect('consumers/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'userTypeData'=>'',
                'supervisorData' => ''
            ]);
        }
    }

    /**
     * Updates an existing AelUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $model->password = '';
        $modelUserType =  new \app\models\AelUserType();
        if ($model->load(Yii::$app->request->post())) {
            if($_POST['AelConsumers']['password']!='') {
                $model->password = md5($_POST['AelConsumers']['password']);
                $passwordHash = Yii::$app->security->generatePasswordHash($_POST['AelConsumers']['password']);
                $model->password_hash = $passwordHash;
            }    
            $model->user_type = 4;
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Consumer updated successfully');
                return $this->redirect('consumers/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'userTypeData'=> '',
                'supervisorData' => ''
            ]);
        }
    }

    /**
     * Deletes an existing AelUser model.
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
     * Finds the AelUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelConsumers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
