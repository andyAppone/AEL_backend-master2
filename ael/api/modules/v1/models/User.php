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
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_user';
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
    
    public function checkUser($postData) {
	$userEmail =  $postData['user_email'];
	$password = md5($postData['password']);
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
    
    public function updateprofile($postData) {
        $authKey = '';
        $firtName = '';
        $firstNameChi = '';
        $lastName = '';
        $lastNameChi = '';
        $gender = '';
        $udid = '';
        $gcm = '';
        $website = '';
        if(isset($postData['sessionkey'])) {
            $authKey = $postData['sessionkey'];
        }
        if(isset($postData['first_name'])) {
            $firtName = $postData['first_name'];
        }
        if(isset($postData['first_name_chi'])) {
            $firstNameChi = $postData['first_name_chi'];
        }
        if(isset($postData['last_name'])) {
            $lastName = $postData['last_name'];
        }
        if(isset($postData['last_name_chi'])) {
            $lastNameChi = $postData['last_name_chi'];
        }
        if(isset($postData['gender'])) {
            $gender = $postData['gender'];
        }
        if(isset($postData['udid'])) {
            $udid = $postData['udid'];
        }
        if(isset($postData['gcm'])) {
            $gcm = $postData['gcm'];
        }
        if(isset($postData['website'])) {
            $website = $postData['website'];
        }
        //echo $authKey; die;
        $connection = Yii::$app->db;
        $result = $connection->createCommand()
                ->update('ael_user', ['first_name' => $firtName,'first_name_chi'=>$firstNameChi,'last_name'=>$lastName,'last_name_chi'=>$lastNameChi,'gender'=>$gender,'udid'=>$udid,'gcm'=>$gcm],'auth_key = "'.$authKey.'" ')
                ->execute();
        return '1';
    }


    public function changePassword($postData) {
	$currentpassword = $postData['current_password'];    
	$newPassword = $postData['new_password'];
	$authKey = $postData['sessionkey'];
	
	$query = new Query;
	$query->select('*')
	    ->from('ael_user')
	    ->where(['password' => md5($currentpassword)]); //'password_hash'=>$password
	$command = $query->createCommand();
	$userData = $command->queryAll();
	
	if(!empty($userData)) {
	    $passwordHash = Yii::$app->security->generatePasswordHash($newPassword);	
	    $connection = Yii::$app->db;
	    $result = $connection->createCommand()
			->update('ael_user', ['password_hash' => $passwordHash,'password'=>md5($newPassword)],'auth_key = "'.$authKey.'" ')
			->execute();
	    if($result) {
		return '1';
	    } else {
		return '2';
	    }
	} else {
	    return '3';
	}
    }
    
    public function forgotPassword($postData) {
	$userMobile = $postData['user_mobile'];    
	$email = $postData['email'];
	
	$query = new Query;
	$query->select('*')
	    ->from('ael_user')
	    ->where(' email = "'.$email.'" OR (user_mobile = "'.$userMobile.'" AND user_mobile IS NOT NULL) ');
	$command = $query->createCommand();
	$userData = $command->queryAll(); 
	
	$user = (object)$userData[0];
	
	$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
	$bodyData = '<div class="password-reset">
	    <p>Hello '.Html::encode($user->username).',</p>
	    <p>Follow the link below to reset your password:</p>
	    <p>'.Html::a(Html::encode($resetLink), $resetLink).'</p>
	</div>';
	
	if(!empty($userData)) {
	    \Yii::$app->mail->compose()
	    ->setFrom(['nikultaka@gmail.com' => 'Test Mail'])
	    ->setTo($email)
	    ->setHtmlBody($bodyData)	    
	    ->setSubject('Password Reset')
	    ->send();
	    return '1';
	} else {
	    return '2';
	}
    }
    
    public function logout($postData) {
	$sessionkey = $postData['sessionkey'];
	
	$query = new Query;
	$query->select('*')
	    ->from('ael_user')
	    ->where(' auth_key = "'.$sessionkey.'" ');
	$command = $query->createCommand();
	$userData = $command->queryAll();
	if(!empty($userData)) {
	    return '1';
	} else {
	    return '2';
	}
    }
}

