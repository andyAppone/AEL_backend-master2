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
use yii\db\Query;


/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class UsersController extends ActiveController
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
    
    public function actionTasklist() {
        try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\Leaves();
	    $sessionkey = '';
            $userType = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
            $connection = new \yii\db\Query();
                $connection->select('*')
                ->from('ael_user')
                ->where(' auth_key = "'.$sessionkey.'" ');
                $command = $connection->createCommand();
                $userData = $command->queryAll();
            
            if(!empty($userData)) {
                $userType = $userData[0]['user_type'];
                $userID = $userData[0]['id'];
                $where = "1";
                if($userType == '1') {
                    $where = " supervisor_id  = ".$userID."  ";
                }
                if($userType == '2') {
                    $where = " worker_1_id  = ".$userID."  ";
                }
                if($userType == '3') {
                    $where = " worker_2_id  = ".$userID."  ";
                }
                /*************************** PM Data *********************/
                $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_lift_pm')
                    ->where($where);
                    $command = $connection->createCommand();
                $liftData = $command->queryAll();
                $scheduled = array();
                $inprogress = array();
                $followup = array();
                foreach($liftData as $key => $value) {
                    if($value['pm_status'] == '1') {
                        $scheduled[] = $value['pm_status'];
                    }
                    if($value['pm_status'] == '3') {
                        $inprogress[] = $value['pm_status'];
                    }
                    if($value['pm_status'] == '4') {
                        $followup[] = $value['pm_status'];
                    }
                }
                $pmData = array("Scheduled"=>count($scheduled),"InProgress"=>count($inprogress),"NeedFollowUp"=>count($followup));
                /***************************** Ecall Data *******************/
                $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_lift_ecall')
                    ->where($where);
                    $command = $connection->createCommand();
                $liftData = $command->queryAll();
                $accepted = array();
                $pending = array();
                $needResponse = array();
                foreach($liftData as $key => $value) {
                    if($value['ecall_status'] == '2') {
                        $accepted[] = $value['ecall_status'];
                    }
                    if($value['ecall_status'] == '1') {
                        $pending[] = $value['ecall_status'];
                    }
                    if($value['ecall_status'] == '3') {
                        $needResponse[] = $value['ecall_status'];
                    }
                }
                $ecallData = array("Accepted"=>count($accepted),"Pending"=>count($pending),"NeedResponse"=>count($needResponse));
            }
            return array("sessionkey"=>$sessionkey,"status"=>"1","message"=>"Task List.","PM"=>$pmData,"Ecall"=>$ecallData);
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	}
    }


    public function actionUserdata()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\Leaves();
	    $sessionkey = '';
            $userType = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['user_type'])) {
		$userType = $_POST['user_type'];    
	    }
            $connection = new \yii\db\Query();
                $connection->select('*')
                ->from('ael_user')
                ->where(' auth_key = "'.$sessionkey.'" ');
                $command = $connection->createCommand();
                $userData = $command->queryAll();
            
            if(!empty($userData)) {    
                $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_user')
                    ->where(' user_type IN ('.$userType.') ');
                    $command = $connection->createCommand();
                    $userData = $command->queryAll();    
            }
            return array("sessionkey"=>$sessionkey,"status"=>"1","message"=>"User Data","data"=>$userData);
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionPettycashlist()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\Leaves();
	    $sessionkey = '';
            $userID = '';
            $fromDate = '';
            $toDate = '';
            $others = '';
            $serviceID = '';
            $serviceType = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['user_id'])) {
		$userID = $_POST['user_id'];    
	    }
	    if(isset($_POST['from_date'])) {
		$fromDate = $_POST['from_date'];    
	    }
            if(isset($_POST['to_date'])) {
		$toDate = $_POST['to_date'];    
	    }
            if(isset($_POST['others'])) {
		$others = $_POST['others'];    
	    }
            if(isset($_POST['service_id'])) {
		$serviceID = $_POST['service_id'];    
	    }
            if(isset($_POST['service_type'])) {
		$serviceType = $_POST['service_type'];    
	    }
            $where = '';
            if($others == '0') {
                $connection = new \yii\db\Query();
                $connection->select('*')
                ->from('ael_user')
                ->where(' auth_key = "'.$sessionkey.'" ');
                $command = $connection->createCommand();
                $userData = $command->queryAll();
                if(!empty($userData)) {
                    $userID = $userData[0]['id'];
                    $where = " staff_id  = ".$userID." ";
                    if($fromDate && $toDate !='') {
                        $where.= " AND (petty_cash_date >= '".$fromDate."' AND petty_cash_date<='".$toDate."')  ";
                    }
                    $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_petty_cash')
                    ->where($where);
                    $command = $connection->createCommand();
                    $pettycashData = $command->queryAll();
                }
            } else if($others == '1') {
                    $where.= ' staff_id =  '.$userID;
                    if($fromDate && $toDate !='') {
                        $where.=" AND (petty_cash_date >= '".$fromDate."' AND petty_cash_date<='".$toDate."')   ";
                    }
                    $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_petty_cash')
                    ->where($where);
                    $command = $connection->createCommand();
                    $pettycashData = $command->queryAll();
            } else if($others == '2') {
                    $where.= ' service_id = '.$serviceID.' AND service_type = "'.$serviceType.'" ';
                    if($fromDate && $toDate !='') {
                        $where.=" AND (petty_cash_date >= '".$fromDate."' AND petty_cash_date<='".$toDate."')   ";
                    }
                    $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_petty_cash')
                    ->where($where);
                    $command = $connection->createCommand();
                    $pettycashData = $command->queryAll();
            }
            return array("sessionkey"=>$sessionkey,"status"=>"1","message"=>"Leave list","data"=>$pettycashData);
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    
    public function actionUpdatepettycash()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
	    $sessionKey = '';
	    $userID = '';
            $serviceID = '';
            $serviceQRCode = '';
            $amountFare = '';
            $amountOt = '';
            $amountExtra = '';
            $serviceType = '';
            $pettyCashDate = '';
            $liftID = '';
            $status = '';
            $approvedBy = '';
            $pettyCashID = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionKey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['user_id'])) {
		$userID = $_POST['user_id'];    
	    }
            if(isset($_POST['service_id'])) {
		$serviceID = $_POST['service_id'];    
	    }
            if(isset($_POST['service_qr_code'])) {
		$serviceQRCode = $_POST['service_qr_code'];    
	    }
            if(isset($_POST['amount_fare'])) {
		$amountFare = $_POST['amount_fare'];    
	    }
            if(isset($_POST['amount_ot'])) {
		$amountOt = $_POST['amount_ot'];    
	    }
            if(isset($_POST['amount_extra'])) {
		$amountExtra = $_POST['amount_extra'];    
	    }
            if(isset($_POST['service_type'])) {
		$serviceType = $_POST['service_type'];    
	    }
            if(isset($_POST['petty_cash_date'])) {
		$pettyCashDate = $_POST['petty_cash_date'];    
	    }
            if(isset($_POST['lift_id'])) {
		$liftID = $_POST['lift_id'];    
	    }
            if(isset($_POST['status'])) {
		$status = $_POST['status'];    
	    }
            if(isset($_POST['approved_by'])) {
		$approvedBy = $_POST['approved_by'];    
	    }
            if(isset($_POST['petty_cash_id'])) {
		$pettyCashID = $_POST['petty_cash_id'];    
	    }
            
            $query = new \yii\db\Query();
            $query->select('*')
                ->from('ael_user')
                ->where('auth_key =  "'.$sessionKey.'" '); //'password_hash'=>$password
            $command = $query->createCommand();
            $userData = $command->queryAll();
            
            if(!empty($userData)) {
                $userID = $userData[0]['id'];    
                $connection = Yii::$app->db;
                if($pettyCashID == '') {
                    $result = $connection->createCommand()
                            ->insert('ael_petty_cash', ['staff_id'=>$userID,'service_id'=>$serviceID,'service_qr_code'=>$serviceQRCode,'amount_fare'=>$amountFare,
                                'amount_ot'=>$amountOt,'amount_extra'=>$amountExtra,'petty_cash_date'=>$pettyCashDate,
                                'service_type'=>$serviceType,'petty_cash_date'=>$pettyCashDate,'lift_id'=>$liftID,'status'=>'0','created_datetime'=>date("Y-m-d H:i:s"),'updated_datetime'=>date("Y-m-d H:i:s")])
                            ->execute();
                    return array('sessionkey'=>$sessionKey,"status"=>"1","message"=>"Petty cash added successfully");
                } else {
                    $result = $connection->createCommand()
                            ->update('ael_petty_cash', ['service_id'=>$serviceID,'service_qr_code'=>$serviceQRCode,'amount_fare'=>$amountFare,
                                'amount_ot'=>$amountOt,'amount_extra'=>$amountExtra,'petty_cash_date'=>$pettyCashDate,
                                'service_type'=>$serviceType,'petty_cash_date'=>$pettyCashDate,'lift_id'=>$liftID,'status'=>$status
                                ,'approved_by'=>$approvedBy,'updated_datetime'=>date("Y-m-d H:i:s")],' id =  '.$pettyCashID.' ')
                            ->execute();
                    return array('sessionkey'=>$sessionKey,"status"=>"1","message"=>"Petty cash updated successfully");
                }
                
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    
    public function actionLogin()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
	    $userEmail = '';
	    $password = '';
	    $udid = '';
	    $gcm = '';
	    $mobileType = '';
	    $userLat = '';
	    $userLong = '';
	    $qrCode = '';
	    $loginType = '';
	    if(isset($_POST['user_email'])) {
		$userEmail = $_POST['user_email'];
	    }
	    if(isset($_POST['password'])) {
		$password = $_POST['password'];    
	    }
	    if(isset($_POST['udid'])) {
		$udid = $_POST['udid'];
	    }
	    if(isset($_POST['gcm'])) {
		$gcm = $_POST['gcm'];
	    }
	    if(isset($_POST['mobile_type'])) {
		$mobileType = $_POST['mobile_type'];
	    }
	    if(isset($_POST['user_lat'])) {
		$userLat = $_POST['user_lat'];
	    }
	    if(isset($_POST['user_long'])) {
		$userLong = $_POST['user_long'];
	    }
	    if(isset($_POST['qr_code'])) {
		$qrCode = $_POST['qr_code'];
	    }
	    if(isset($_POST['login_type'])) {
		$loginType = $_POST['login_type'];
	    }
	    $userData = $modelUser->checkUser($_POST);
	    if(!empty($userData)) {
		return array("status"=>1,"message"=>"Logged In Successfully","sessionkey"=>$userData[0]['auth_key'],"data"=>$userData);
	    } else {
		return array("status"=>2,"message"=>"User not found","data"=>$userData);
	    }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionChangepassword()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
	    $sessionkey = '';
	    $currentpassword = '';
	    $newPassword = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['current_password'])) {
		$currentpassword = $_POST['current_password'];    
	    }
	    if(isset($_POST['new_password'])) {
		$newPassword = $_POST['new_password'];
	    }
	    $userData = $modelUser->changePassword($_POST);
	    if($userData == '1') {
		return array("status"=>1,"message"=>"Password changed successfully");
	    } else if($userData == '3') {
		return array("status"=>2,"message"=>"Wrong password");
	    } else {
		return array("status"=>404,"error"=>"Something went wrong");
	    }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionForgotpassword()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
	    $userMobile = '';
	    $email = '';
	    if(isset($_POST['user_mobile'])) {
		$userMobile = $_POST['user_mobile'];
	    }
	    if(isset($_POST['email'])) {
		$email = $_POST['email'];    
	    }
	    $userData = $modelUser->forgotPassword($_POST);
	    if($userData == '1') {
		return array("status"=>1,"message"=>"E-mail sent to your registered email address successfully.");
	    } else if($userData == '2') {
		return array("status"=>2,"message"=>"Email or mobile number not found");
	    } else {
		return array("status"=>404,"error"=>"Something went wrong");
	    }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionUpdateprofile() {
            try {
                $modelUser = new \api\modules\v1\models\User();
                
                $userData = $modelUser->updateprofile($_POST);
                $authKey = '';
                if(isset($_POST['sessionkey'])) {
                    $authKey = $_POST['sessionkey'];
                }
                if($userData == '1') {
                    $query = new \yii\db\Query();
                    $query->select('*')
                        ->from('ael_user')
                        ->where(['auth_key'=>$authKey]);
                    $command = $query->createCommand();
                    $userData = $command->queryAll();
                    return array("status"=>1,"sessionkey"=>$authKey,"message"=>"Your profile updated successfully.","user"=>$userData);
                } else {
                    return array("status"=>404,"error"=>"Something went wrong");
                }
            } catch (ErrorException $e) {   
                return array("status"=>404,"error"=>"Something went wrong");
            } 
    }


    public function actionLogout()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
	    $sessionkey = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    $userData = $modelUser->logout($_POST);
	    if($userData == '1') {
		return array("status"=>1,"message"=>"Logged out successfully.");
	    } else if($userData == '2') {
		return array("status"=>404,"error"=>"Something went wrong");
	    }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
}
