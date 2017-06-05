<?php

namespace api\modules\v1\models;


use Yii;
use yii\db\Query;

/**
 * This is the model class for table "ael_lift".
 *
 * @property integer $id
 * @property string $lift_name
 * @property string $lift_name_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $client_id
 * @property integer $last_pm_details
 * @property string $lift_qr_code
 * @property string $lift_brand
 * @property string $lift_address
 * @property string $lift_address_chi
 * @property string $lift_installation_date
 * @property string $lift_lat
 * @property string $lift_long
 */
class AelLift extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_lift';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active','lift_name','lift_name_chi','client_id','lift_brand', 'lift_address', 'lift_address_chi', 'lift_installation_date', 'lift_lat', 'lift_long'], 'required'],
            [['created_datetime', 'updated_datetime', 'lift_installation_date'], 'safe'],
            [['is_active', 'is_deleted'], 'string'],
            [['client_id', 'last_pm_details'], 'integer'],
            [['lift_name', 'lift_name_chi', 'lift_qr_code', 'lift_brand'], 'string', 'max' => 50],
            [['lift_address', 'lift_address_chi'], 'string', 'max' => 255],
            [['lift_lat', 'lift_long'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lift_name' => 'Lift Name',
            'lift_name_chi' => 'Lift Name Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
            'client_id' => 'Consumer',
            'last_pm_details' => 'Last Pm Details',
            'lift_qr_code' => 'Lift Qr Code',
            'lift_brand' => 'Lift Brand',
            'lift_address' => 'Lift Address',
            'lift_address_chi' => 'Lift Address Chi',
            'lift_installation_date' => 'Lift Installation Date',
            'lift_lat' => 'Lift Lat',
            'lift_long' => 'Lift Long',
        ];
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->created_datetime = date("Y-m-d H:i:s");
            $this->updated_datetime = date("Y-m-d H:i:s");
            return true;
        } else {
            return false;
        }
    }
    
    public function getliftlist($data) {
        $sessionkey = '';
        $page = '';
        $search = '';
        if(isset($data['sessionkey'])) {
            $sessionkey = $data['sessionkey'];
        }
        if(isset($data['page'])) {
            $page = $data['page'];    
        }
        if(isset($data['search'])) {
            $search = $data['search'];
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
        if($sessionkey == '') {
            $query->select('*')
                ->from('ael_lift')
                ->where("lift_name LIKE '%".$search."%' OR lift_qr_code = '".$search."' ")
                ->limit(10)
                ->offset($offset);
            $command = $query->createCommand();
            $liftData = $command->queryAll();
        } else {
            $query->select('*')
	    ->from('ael_user')
	    ->where(' auth_key = "'.$sessionkey.'" ');
            $command = $query->createCommand();
            $userData = $command->queryAll();
            if(!empty($userData)) {
                $userID = $userData[0]['id'];
                $query->select('*')
                    ->from('ael_lift')
                    ->where(' client_id = "'.$userID.'" ');
                $command = $query->createCommand();
                $liftData = $command->queryAll();
            }
        }	
        return $liftData;
    } 
    
    public function getliftrecords($data) {
        $sessionkey = '';
        $page = '';
        $search = '';
        $liftID = '';
        $liftQrCode = '';
        $serviceType = '';
        if(isset($data['sessionkey'])) {
            $sessionkey = $data['sessionkey'];
        }
        if(isset($data['page'])) {
            $page = $data['page'];    
        }
        if(isset($data['search'])) {
            $search = $data['search'];
        }
        if(isset($data['lift_id'])) {
            $liftID = $data['lift_id'];
        }
        if(isset($data['lift_qr_code'])) {
            $liftQrCode = $data['lift_qr_code'];
        }
        if(isset($data['service_type'])) {
            $serviceType = $data['service_type'];
        }
        
        $searchString = '1';
        if($search != '') {
            if(strtolower($serviceType) == 'pm') {
                $searchString =  "(lift_id = '".$liftID."') OR (pm_qr_code = '".$liftQrCode."') ";
            } else if(strtolower($serviceType) == 'ecall') {
                $searchString =  "(lift_id = '".$liftID."') OR (ecall_qr_code = '".$liftQrCode."') ";
            }
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
	    ->where(' auth_key = "'.$sessionkey.'" ');
            $command = $query->createCommand();
            $userData = $command->queryAll();
        if(empty($userData)) {
           return '2'; 
        }
        
        if(strtolower($serviceType) == 'pm') {
            $query->select('*')
                ->from('ael_lift_pm')
                ->where($searchString)
                ->limit(10)
                ->offset($offset);
            $command = $query->createCommand();
            $liftData = $command->queryAll();
        } else if(strtolower($serviceType) == 'ecall') {
            $query->select('*')
                ->from('ael_lift_ecall')
                ->where($searchString)
                ->limit(10)
                ->offset($offset);
            $command = $query->createCommand();
            $liftData = $command->queryAll();
        }	
        return $liftData;
    }
}
