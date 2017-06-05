<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password
 * @property string $password_reset_token
 * @property integer $status
 * @property string $email
 * @property string $qr_code
 * @property string $first_name
 * @property string $first_name_chi
 * @property string $last_name
 * @property string $last_name_chi
 * @property string $gender
 * @property string $udid
 * @property string $gcm
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $user_email
 * @property string $user_mobile
 * @property string $mobile_type
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $user_type
 * @property string $user_lat
 * @property string $user_long
 * @property string $designation
 * @property string $designation_chi
 * @property string $address
 * @property string $address_chi
 * @property integer $supervisor_id
 */
class AelConsumers extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['first_name','first_name_chi','last_name','last_name_chi','gender','username','password','email','user_mobile','address','address_chi','is_active'], 'required','on' => 'create'],
            [['first_name','first_name_chi','last_name','last_name_chi','gender','user_mobile','address','address_chi','is_active'], 'required','on' => 'update'],
            ['email', 'email'],
            ['email', 'unique','message'=>'This Email is already in use'],
            ['username', 'unique','message'=>'This username is already in use'],
            [['status', 'created_at', 'updated_at', 'user_type', 'supervisor_id'], 'integer'],
            [['gender', 'is_active', 'is_deleted'], 'string'],
            [['username', 'qr_code', 'first_name', 'first_name_chi', 'last_name', 'last_name_chi', 'udid', 'mobile_type', 'designation', 'designation_chi'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password', 'password_reset_token', 'email', 'gcm', 'user_email', 'user_mobile', 'address', 'address_chi'], 'string', 'max' => 255],
            [['user_lat', 'user_long'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'email' => 'Email',
            'qr_code' => 'Qr Code',
            'first_name' => 'First Name',
            'first_name_chi' => 'First Name Chi',
            'last_name' => 'Last Name',
            'last_name_chi' => 'Last Name Chi',
            'gender' => 'Gender',
            'udid' => 'Udid',
            'gcm' => 'Gcm',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_email' => 'User Email',
            'user_mobile' => 'User Mobile',
            'mobile_type' => 'Mobile Type',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
            'user_type' => 'User Type',
            'user_lat' => 'User Lat',
            'user_long' => 'User Long',
            'designation' => 'Designation',
            'designation_chi' => 'Designation Chi',
            'address' => 'Address',
            'address_chi' => 'Address Chi',
            'supervisor_id' => 'Supervisor ID',
        ];
    }
    public function getMessageTrigger() {
        return $this->hasOne(AelUserType::className(), ['id' => 'user_type']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->created_at = time();
            $this->updated_at = time();
            return true;
        } else {
            return false;
        }
    }
}
