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


/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class LeavesController extends ActiveController
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
    public function actionRequestleave()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\Leaves();
	    $sessionkey = '';
	    $leaveStartDate = '';
	    $leaveStartTime = '';
            $leaveEndDate = '';
	    $leaveEndTime = '';
            $leaveType = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['leave_start_date'])) {
		$leaveStartDate = $_POST['leave_start_date'];    
	    }
	    if(isset($_POST['leave_start_time'])) {
		$leaveStartTime = $_POST['leave_start_time'];    
	    }
            if(isset($_POST['leave_end_Date'])) {
		$leaveEndDate = $_POST['leave_end_Date'];    
	    }
            if(isset($_POST['leave_end_time'])) {
		$leaveEndTime = $_POST['leave_end_time'];    
	    }
            if(isset($_POST['leave_type'])) {
		$leaveType = $_POST['leave_type'];    
	    }
            if(isset($_POST['total_leave_days'])) {
		$totalLeaveDays = $_POST['total_leave_days'];    
	    }
            $leaveStartDateTime =  $leaveStartDate.' '.$leaveStartTime;
            $leaveStart = date("Y-m-d H:i:s",strtotime($leaveStartDateTime));
            
            $leaveEndDateTime =  $leaveEndDate.' '.$leaveEndTime;
            $leaveEnd = date("Y-m-d H:i:s",strtotime($leaveEndDateTime));
            
            $connection = new \yii\db\Query();
            $connection->select('*')
	    ->from('ael_user')
	    ->where(' auth_key = "'.$sessionkey.'" ');
            $command = $connection->createCommand();
            $userData = $command->queryAll();
            
            if(!empty($userData)) {
                $connection = new \yii\db\Query();
                $leaveData = $connection->createCommand()
                            ->insert('ael_leave', [
                                            'user_id' => $userData[0]['id'],
                                            'leave_start_date' =>$leaveStartDate,
                                            'leave_start_time' => $leaveStartTime,
                                            'leave_end_date' => $leaveEndDate,
                                            'leave_end_time' => $leaveEndTime,
                                            'leave_type' => $leaveType,
                                            'status'=> '2',
                                            'total_leave_days' => $totalLeaveDays,
                                            'created_datetime'=>date("Y-m-d H:i:s"),
                                            'updated_datetime'=>date("Y-m-d H:i:s")
                                ])
                            ->execute();
                return array("status"=>1,"sessionkey"=>$sessionkey,"message"=>"Your leave request received."); 
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }

    
    public function actionLeavelist()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\Leaves();
	    $sessionkey = '';
            $userID = '';
            $fromDate = '';
            $toDate = '';
            $others = '';
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
            
            if($others == '0') {
                $connection = new \yii\db\Query();
                $connection->select('*')
                ->from('ael_user')
                ->where(' auth_key = "'.$sessionkey.'" ');
                $command = $connection->createCommand();
                $userData = $command->queryAll();
                if(!empty($userData)) {
                    $userID = $userData[0]['id'];
                    $where = " user_id  = ".$userID." ";
                    if($fromDate && $toDate !='') {
                        $where.= " AND (leave_start_date >= '".$fromDate."' AND leave_end_date<='".$toDate."')  ";
                    }
                    $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_leave')
                    ->where($where);
                    $command = $connection->createCommand();
                    $leaveData = $command->queryAll();
                }
            } else {
                    $where = '1';
                    if($fromDate && $toDate !='') {
                        $where= " (leave_start_date >= '".$fromDate."' AND leave_end_date<='".$toDate."')  ";
                    }
                    $connection = new \yii\db\Query();
                    $connection->select('*')
                    ->from('ael_leave')
                    ->where($where);
                    $command = $connection->createCommand();
                    $leaveData = $command->queryAll();
            }
            return array("sessionkey"=>$sessionkey,"status"=>"1","message"=>"Leave list","data"=>$leaveData);
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionUpdatestatus()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\Leaves();
	    $sessionkey = '';
	    $leaveID = '';
            $status = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['leave_id'])) {
		$leaveID = $_POST['leave_id'];    
	    }
	    if(isset($_POST['status'])) {
		$status = $_POST['status'];    
	    }
            $connection = new \yii\db\Query();
            $connection->select('*')
	    ->from('ael_user')
	    ->where(' auth_key = "'.$sessionkey.'" ');
            $command = $connection->createCommand();
            $userData = $command->queryAll();
            
            if(!empty($userData)) {
                $connection = new \yii\db\Query();
                $connection	->createCommand()
			->update('ael_leave', ["status"=>$status,"updated_datetime"=>date("Y-m-d H:i:s")], 'id = '.$leaveID)
			->execute();
                return array("status"=>1,"sessionkey"=>$sessionkey,"message"=>"Your leave status updated successfully"); 
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
}
