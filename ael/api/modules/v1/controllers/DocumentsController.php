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
class DocumentsController extends ActiveController
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
    public function actionDocumentcategorylist()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelDocument = new \api\modules\v1\models\Document();
	    $categoryData = $modelDocument->getdoccategorylist($_POST);
            if($categoryData == '2') {
                return array("status"=>404,"data"=>"Session key invaild");
            } else {
                return array("status"=>1,"sessionkey"=>$_POST['sessionkey'],"data"=>$categoryData); 
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
    
    public function actionDocumentlist()
    {
	try {
	    $modelUser = new \api\modules\v1\models\User();
            $modelDocument = new \api\modules\v1\models\Document();
	    $documentData = $modelDocument->getdoclist($_POST);
            if($documentData == '2') {
                return array("status"=>404,"data"=>"Session key invaild");
            } else {
                return array("status"=>1,"sessionkey"=>$_POST['sessionkey'],"data"=>$documentData); 
            }
	} catch (ErrorException $e) {   
	    return array("status"=>404,"error"=>"Something went wrong");
	} 
    }
    
 
    
}
