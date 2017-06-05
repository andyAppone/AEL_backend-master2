<?php

namespace backend\controllers;

use Yii;
use app\models\AelEcall;
use app\models\AelEcallSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\formats\MailTo;

/**
 * PmController implements the CRUD actions for AelLiftPm model.
 */
class EcallController extends Controller
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
     * Lists all AelLiftPm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelEcallSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelLiftPm model.
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
     * Creates a new AelLiftPm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelEcall();
        $modelUser = new \app\models\AelUser();
        $modelLift = new \app\models\AelLift();
        $modelChecklist = new \app\models\AelServiceChecklist();
        
        $cosumersData = $modelUser->find()->select('first_name as label,id')->where("user_type='4'")->asArray()->all();
        $liftData = $modelLift->find()->select('lift_name as label,id')->where("1")->asArray()->all();
        $supervisorData = $modelUser->find()->select('first_name as label,id')->where("user_type='1'")->asArray()->all();
        $workerData = $modelUser->find()->select('first_name as label,id')->where("user_type='3'")->asArray()->all();
        $engineerData = $modelUser->find()->select('first_name as label,id')->where("user_type='2'")->asArray()->all();
        $checklistData = $modelChecklist->find()->select('lift_checklist_details as label,id')->where(" is_active = '1' AND lift_checklist_type = 'P' ")->asArray()->all();
        
        if ($model->load(Yii::$app->request->post())) {
            $maxData = $model->find()->select('id')->orderBy('id DESC')->asArray()->one(); 
            if(!empty($maxData)) {
                $maxData = $maxData['id'];
            } else {
                $maxData = 0;
            }
            $maxData+=1;
            $qrcodeNumber =  "SEC00000000".$maxData; 
            $generateQRcode = QrCode::png($qrcodeNumber,'../assets/qrcode/'.$qrcodeNumber.'.png');
            $model->ecall_qr_code = $qrcodeNumber;
            
            $checklistdata = implode(',',$_POST['AelEcall']['ecall_service_checklist']);
            $model->ecall_service_checklist = $checklistdata;
            $model->ecall_launch_datetime = date("Y-m-d H:i:s",strtotime($_POST['AelEcall']['ecall_launch_datetime']));
            
            if($model->save()) {
                if($model->ecall_status == '4') {
                    $modelHistories = new \app\models\AelServiceHistories();
                    $historyData = $modelHistories->find()->select('*')->where("pm_e_call = ".$model->id." ")->asArray()->all();
                    
                    if(empty($historyData)) {
                        $connection =  new \yii\db\Query();
                        $connection->createCommand()
                                    ->insert('ael_service_histories', [
                                                    'pm_e_call' => $model->id,
                                                    'qr_code' => $model->ecall_qr_code,
                                                    'lift_name' => $model->lift_name,
                                                    'lift_name_chi' => $model->lift_name_chi,
                                                    'lift_id' => $model->lift_id,
                                                    'created_datetime' => date("Y-m-d H:i:s"),
                                                    'updated_datetime' => date("Y-m-d H:i:s"),
                                                    'registered_datetime' => $model->ecall_launch_datetime,
                                                    'client_id' => $model->client_id,
                                                    'worker_1_id' => $model->worker_1_id,
                                                    'worker_2_id' => $model->worker_2_id,
                                                    'supervisor_id' => $model->supervisor_id,
                                                    'service_checklist'=>$model->ecall_service_checklist,
                                                    'status' => $model->ecall_status
                                        ])
                                    ->execute();
                    }    
                }
                return $this->redirect('ecall/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'cosumersData'=>$cosumersData,
                'liftData' =>$liftData,
                'supervisorData'=>$supervisorData,
                'workerData' => $workerData,
                'engineerData'=>$engineerData,
                'checklistData'=>$checklistData
            ]);
        }
    }

    /**
     * Updates an existing AelLiftPm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUser = new \app\models\AelUser();
        $modelLift = new \app\models\AelLift();
        $modelChecklist = new \app\models\AelServiceChecklist();
        
        $cosumersData = $modelUser->find()->select('first_name as value,first_name as label,id as id')->where("user_type='4'")->asArray()->all();
        $liftData = $modelLift->find()->select('lift_name as label,id')->where("1")->asArray()->all();
        $supervisorData = $modelUser->find()->select('first_name as label,id')->where("user_type='1'")->asArray()->all();
        $workerData = $modelUser->find()->select('first_name as label,id')->where("user_type='3'")->asArray()->all();
        $engineerData = $modelUser->find()->select('first_name as label,id')->where("user_type='2'")->asArray()->all();
        $checklistData = $modelChecklist->find()->select('lift_checklist_details as label,id')->where(" is_active = '1' AND lift_checklist_type = 'P' ")->asArray()->all();
        
        $checklistdata = explode(',',$model->ecall_service_checklist);
        $model->ecall_service_checklist = $checklistdata;
        //$model->pm_schedule_start_datetime = date("d F Y - H:i a",strtotime($model->pm_schedule_start_datetime));
        //$model->pm_schedule_end_datetime = date("d F Y - H:i a",strtotime($model->pm_schedule_end_datetime));
        
        if ($model->load(Yii::$app->request->post())) {
            $checklistdata = implode(',',$_POST['AelEcall']['ecall_service_checklist']);
            $model->ecall_service_checklist = $checklistdata;
            $model->ecall_launch_datetime = date("Y-m-d H:i:s",strtotime($_POST['AelEcall']['ecall_launch_datetime']));
            
            if($model->save()) {
                if($model->ecall_status == '4') {
                    $modelHistories = new \app\models\AelServiceHistories();
                    $historyData = $modelHistories->find()->select('*')->where("pm_e_call = ".$model->id." ")->asArray()->all();
                    
                    if(empty($historyData)) {
                        $connection =  new \yii\db\Query();
                        $connection->createCommand()
                                    ->insert('ael_service_histories', [
                                                    'pm_e_call' => $model->id,
                                                    'qr_code' => $model->ecall_qr_code,
                                                    'lift_name' => $model->lift_name,
                                                    'lift_name_chi' => $model->lift_name_chi,
                                                    'lift_id' => $model->lift_id,
                                                    'created_datetime' => date("Y-m-d H:i:s"),
                                                    'updated_datetime' => date("Y-m-d H:i:s"),
                                                    'registered_datetime' => $model->ecall_launch_datetime,
                                                    'client_id' => $model->client_id,
                                                    'worker_1_id' => $model->worker_1_id,
                                                    'worker_2_id' => $model->worker_2_id,
                                                    'supervisor_id' => $model->supervisor_id,
                                                    'service_checklist'=>$model->ecall_service_checklist,
                                                    'status' => $model->ecall_status
                                        ])
                                    ->execute();
                    }    
                }
                return $this->redirect('ecall/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'cosumersData'=>$cosumersData,
                'liftData' =>$liftData,
                'supervisorData'=>$supervisorData,
                'workerData' => $workerData,
                'engineerData'=>$engineerData,
                'checklistData'=>$checklistData,
                'seelctedData'=>''
            ]);
        }
    }

    /**
     * Deletes an existing AelLiftPm model.
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
     * Finds the AelLiftPm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelLiftPm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelEcall::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
