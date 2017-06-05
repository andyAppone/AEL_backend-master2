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
class LiftsController extends ActiveController
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
    public function actionLiftlist()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\AelLift();
	    $sessionkey = '';
	    $page = '';
	    $search = '';
	    if(isset($_POST['sessionkey'])) {
		$sessionkey = $_POST['sessionkey'];
	    }
	    if(isset($_POST['page'])) {
		$page = $_POST['page'];    
	    }
	    if(isset($_POST['search'])) {
		$search = $_POST['search'];
	    }
	    $liftData = $modelLift->getliftlist($_POST);
            if($liftData == '2') {
                return array("status"=>404,"data"=>"Session key invaild");
            } else {
                return array("status"=>1,"data"=>$liftData); 
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    public function actionLiftrecords()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelLift = new \api\modules\v1\models\AelLift();
	    
	    $liftData = $modelLift->getliftrecords($_POST);
            
            return array("status"=>1,"data"=>$liftData); 
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
}
