<?php

namespace api\modules\v1\models;


use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Query;
use yii\base\Model;
use yii\helpers\Html;

/**
 * Country Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Messages extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_messages';
    }

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * Define rules for validation
     */
    /*public function rules()
    {
        return [
            [['code', 'name', 'population'], 'required']
        ];
    }*/
    
    public function getallrecords($postData) {
        $sessionkey = '';
        $page = '';
        if(isset($postData['sessionkey'])) {
            $sessionkey =  $postData['sessionkey'];
        }
        if(isset($postData['page'])) {
            $page = $postData['page'];
        }
        
        if($page != '') {
            if($page == '1') {
                $offset = 0;
            } else {
                $offset =  ($page-1)*10;
            }
        } else {
            $offset = 0;
        }
        
        $query = new Query;
        
        $query->select('*')
	    ->from('ael_user')
	    ->where('auth_key = "'.$sessionkey.'" ');
        $command = $query->createCommand();
        $userData = $command->queryAll();
        if(empty($userData)) {
           return '2'; 
        }
	$userType = $userData[0]['user_type'];
        $where = '1';
        if($userType == '1') {
            $where =  " message_target_audience = '1' OR  message_target_audience = '6' OR  message_target_audience = '3' ";
        }
        if($userType == '2') {
            $where =  " message_target_audience = '1' OR  message_target_audience = '5' OR  message_target_audience = '3' ";
        }
        if($userType == '3') {
            $where =  " message_target_audience = '1' OR  message_target_audience = '4' OR  message_target_audience = '3' ";
        }
        if($userType == '4') {
            $where =  " message_target_audience = '1' OR  message_target_audience = '2' ";
        }
        $query = new Query;
	$query->select('*')
	    ->from('ael_messages')
            ->where($where)    
	    ->limit(10)
            ->offset($offset); 
	$command = $query->createCommand();
	$messageData = $command->queryAll();
	return $messageData;
    }
    
    public function getreadmessage($postData) {
        $sessionkey = '';
        $messageID = '';
        if(isset($postData['sessionkey'])) {
            $sessionkey =  $postData['sessionkey'];
        }
        if(isset($postData['message_id'])) {
            $messageID = $postData['message_id'];
        }
        
        $query = new Query;
        
        $query->select('*')
	    ->from('ael_user')
	    ->where('auth_key = "'.$sessionkey.'" ');
        $command = $query->createCommand();
        $userData = $command->queryAll();
        if(!empty($userData)) {
            $userID = $userData[0]['id'];
            $sql = " INSERT INTO ael_messages_views (message_id,user_id,message_read_datetime,created_datetime,updated_datetime,is_active,message_read_count) 
                values(".$messageID.",".$userID.",NOW(),NOW(),NOW(),'1','1')";
            \Yii::$app->db->createCommand($sql)->execute();
            return '1';
        } else {
            return '2';
        }
    }
}

