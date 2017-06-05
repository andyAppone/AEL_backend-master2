<?php
namespace api\modules\v1\controllers;



use yii\rest\ActiveController;
use Yii;
use yii\base\ErrorException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use dosamigos\qrcode\QrCode;
use dosamigos\qrcode\formats\MailTo;
use yii\db\Query;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class EcallsController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';
    
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionRegister()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelEcall = new \api\modules\v1\models\Ecall();
            //$modelPM = new \app\models\AelLiftPm();
	    $sessionkey = '';
            $lift_id = '';
            $lift_name = '';
            $lift_name_chi = '';
            $ecall_launch_time = '';
            $ecall_status = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
            if(isset($_POST['lift_id'])) {
                $lift_id = $_POST['lift_id'];
            }
            if(isset($_POST['lift_name'])) {
                $lift_name = $_POST['lift_name'];
            }
            if(isset($_POST['lift_name_chi'])) {
                $lift_name_chi = $_POST['lift_name_chi'];
            }
            if(isset($_POST['ecall_launch_time'])) {
                $ecall_launch_time = $_POST['ecall_launch_time'];
            }
            if(isset($_POST['ecall_status'])) {
                $ecall_status = $_POST['ecall_status'];
            }
            
            $query = new \yii\db\Query();
            $query->select('*')
                ->from('ael_user')
                ->where('auth_key =  "'.$sessionkey.'" '); //'password_hash'=>$password
            $command = $query->createCommand();
            $userData = $command->queryAll();	
            
            if(!empty($userData)) {
                $modelEcall->client_id = $userData[0]['id'];
                $modelEcall->lift_id = $lift_id;
                $modelEcall->lift_name = $lift_name;
                $modelEcall->lift_name_chi = $lift_name_chi;
                $modelEcall->lift_id = $lift_id;
                $modelEcall->ecall_launch_datetime = $ecall_launch_time;
                $modelEcall->ecall_status = $ecall_status;
                
                $maxData = $modelEcall->find()->select('id')->orderBy('id DESC')->asArray()->one(); 
                if(!empty($maxData)) {
                    $maxData = $maxData['id'];
                } else {
                    $maxData = 0;
                }
                $maxData+=1;
                $qrcodeNumber =  "SEC00000000".$maxData; 
                $generateQRcode = QrCode::png($qrcodeNumber,'../../backend/assets/qrcode/'.$qrcodeNumber.'.png');
                $modelEcall->ecall_qr_code = $qrcodeNumber;
                $modelEcall->created_datetime = date("Y-m-d H:i:s");
                $modelEcall->updated_datetime = date("Y-m-d H:i:s");
                
                if($modelEcall->save(false)) {
                    if($modelEcall->ecall_status == '4') {
                        $modelHistories = new \api\modules\v1\models\AelServiceHistories();
                        $historyData = $modelHistories->find()->select('*')->where("pm_e_call = ".$modelEcall->id." ")->asArray()->all();

                        if(empty($historyData)) {
                            $connection =  new \yii\db\Query();
                            $connection->createCommand()
                                        ->insert('ael_service_histories', [
                                                        'pm_e_call' => $modelEcall->id,
                                                        'qr_code' => $modelEcall->ecall_qr_code,
                                                        'lift_name' => $modelEcall->lift_name,
                                                        'lift_name_chi' => $modelEcall->lift_name_chi,
                                                        'lift_id' => $modelEcall->lift_id,
                                                        'created_datetime' => date("Y-m-d H:i:s"),
                                                        'updated_datetime' => date("Y-m-d H:i:s"),
                                                        'registered_datetime' => $modelEcall->ecall_launch_datetime,
                                                        'client_id' => $modelEcall->client_id,
                                                        'worker_1_id' => $modelEcall->worker_1_id,
                                                        'worker_2_id' => $modelEcall->worker_2_id,
                                                        'supervisor_id' => $modelEcall->supervisor_id,
                                                        'service_checklist'=>$modelEcall->ecall_service_checklist,
                                                        'status' => $modelEcall->ecall_status
                                            ])
                                        ->execute();
                        }    
                    }
                    return array("status"=>1,"message"=>"E-call Registered Successfully.");
                } else {
                    return array("status"=>404,"error"=>"Something went wrong");
                }
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionUpdatestatus() {
        try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelEcall = new \api\modules\v1\models\Ecall();
            //$modelPM = new \app\models\AelLiftPm();
	    $sessionkey = '';
            $clientID = '';
            $serviceQRCode = '';
            $serviceID = '';
            $worker1ID = '';
            $worker2ID = '';
            $supervisorID = '';
            $status = '';
            $serviceType = '';
            $startDateTime = '';
            $endDateTime = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
            if(isset($_POST['client_id'])) {
                $clientID = $_POST['client_id'];
            }
            if(isset($_POST['service_qr_code'])) {
                $serviceQRCode = $_POST['service_qr_code'];
            }
            if(isset($_POST['service_id'])) {
                $serviceID = $_POST['service_id'];
            }
            if(isset($_POST['worker_1_id'])) {
                $worker1ID = $_POST['worker_1_id'];
            }
            if(isset($_POST['worker_2_id'])) {
                $worker2ID = $_POST['worker_2_id'];
            }
            if(isset($_POST['supervisor_id'])) {
                $supervisorID = $_POST['supervisor_id'];
            }
            if(isset($_POST['status'])) {
                $status = $_POST['status'];
            }
            if(isset($_POST['service_type'])) {
                $serviceType = $_POST['service_type'];
            }
            if(isset($_POST['start_datetime'])) {
                $startDateTime = $_POST['start_datetime'];
            }
            if(isset($_POST['end_datetime'])) {
                $endDateTime = $_POST['end_datetime'];
            }
            
            $query = new \yii\db\Query();
            $query->select('*')
                ->from('ael_user')
                ->where('auth_key =  "'.$sessionkey.'" '); //'password_hash'=>$password
            $command = $query->createCommand();
            $userData = $command->queryAll();	
            
            $connection = Yii::$app->db;
            if(!empty($userData)) {
                if(strtolower($serviceType) == 'ecall') {
                    $userID = $userData[0]['id'];
                    $result = $connection->createCommand()
                            ->update('ael_lift_ecall',['client_id'=>$userID,'ecall_qr_code'=>$serviceQRCode,'worker_1_id'=>$worker1ID,
                                'worker_2_id'=>$worker2ID,'supervisor_id'=>$supervisorID,'ecall_status'=>$status,
                                'ecall_actual_start_datetime'=>$startDateTime,'ecall_actual_end_datetime'=>$endDateTime,'updated_datetime'=>date("Y-m-d H:i:s")],' id =  '.$serviceID.' ')
                            ->execute();
                    return array('sessionkey'=>$sessionkey,'status'=>'1','message'=>'E-call Details Updated Successfully.');
                } else {
                    $userID = $userData[0]['id'];
                    $result = $connection->createCommand()
                            ->update('ael_lift_pm',['client_id'=>$userID,'pm_qr_code'=>$serviceQRCode,'worker_1_id'=>$worker1ID,
                                'worker_2_id'=>$worker2ID,'supervisor_id'=>$supervisorID,'pm_status'=>$status,
                                'pm_actual_start_datetime'=>$startDateTime,'pm_actual_end_datetime'=>$endDateTime,'updated_datetime'=>date("Y-m-d H:i:s")],' id =  '.$serviceID.' ')
                            ->execute();
                    return array('sessionkey'=>$sessionkey,'status'=>'1','message'=>'PM Details Updated Successfully.');
                }
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	}
    }
    
}
