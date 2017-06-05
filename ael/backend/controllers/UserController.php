<?php

namespace backend\controllers;

use Yii;
use app\models\AelUser;
use app\models\AelUserSearch;
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
class UserController extends Controller
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
        $searchModel = new AelUserSearch();
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
        $model = new AelUser();
        $model->is_active = '1';
        $model->scenario = 'create';
        $modelUserType =  new \app\models\AelUserType();
        $userTypeData = $modelUserType->find()->where(["is_staff"=>'1'])->asArray()->all();
        $supervisorData = $model->find()->where("user_type='1'")->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            $maxData = $model->find()->select('id')->orderBy('id DESC')->asArray()->one(); 
            if(!empty($maxData)) {
                $maxData = $maxData['id'];
            } else {
                $maxData = 0;
            }
            $maxData+=1;
            if($_POST['AelUser']['user_type'] == '1') {
                $qrcodeNumber =  "ES000000".$maxData; 
            } else if($_POST['AelUser']['user_type'] == '2') {
                $qrcodeNumber =  "EE000000".$maxData; 
            } else if($_POST['AelUser']['user_type'] == '3') {
                $qrcodeNumber =  "EW000000".$maxData; 
            }
            
            $generateQRcode = QrCode::png($qrcodeNumber,'../assets/qrcode/'.$qrcodeNumber.'.png');
            $model->qr_code = $qrcodeNumber;
            
            $model->password = md5($_POST['AelUser']['password']);
            $passwordHash = Yii::$app->security->generatePasswordHash($_POST['AelUser']['password']);
            $model->password_hash = $passwordHash;
            $authKey = Yii::$app->security->generateRandomString();
            $model->auth_key = $authKey;
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'User added successfully');
                return $this->redirect('user/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'userTypeData'=>$userTypeData,
                'supervisorData' => $supervisorData
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
        $userTypeData = $modelUserType->find()->where(["is_staff"=>'1'])->asArray()->all();
        $supervisorData = $model->find()->where("user_type='1' AND id != ".$model->id." ")->asArray()->all();
        if ($model->load(Yii::$app->request->post())) {
            if($_POST['AelUser']['password']!='') {
                $model->password = md5($_POST['AelUser']['password']);
                $passwordHash = Yii::$app->security->generatePasswordHash($_POST['AelUser']['password']);
                $model->password_hash = $passwordHash;
            }    
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'User updated successfully');
                return $this->redirect('user/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'userTypeData'=>$userTypeData,
                'supervisorData' => $supervisorData
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
        if (($model = AelUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
