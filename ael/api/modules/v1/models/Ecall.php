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
class Ecall extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_lift_ecall';
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
    
    public function register($postData) {
	$sessionkey =  $postData['sessionkey'];
	$lift_id = $postData['lift_id'];
        $lift_name = $postData['lift_name'];
        $lift_name_chi = $postData['lift_name_chi'];
        $ecall_launch_time = $postData['ecall_launch_time'];
        $ecall_status = $postData['ecall_status'];
	$query = new Query;
	$query->select('*')
	    ->from('ael_user')
	    ->where(['email' => $userEmail,'password'=>$password]); //'password_hash'=>$password
	$command = $query->createCommand();
	$userData = $command->queryAll();	
	$userPassword = $userData[0]['password_hash'];
	$salt = $userData[0]['auth_key']; 
	return $userData;
    }
}

