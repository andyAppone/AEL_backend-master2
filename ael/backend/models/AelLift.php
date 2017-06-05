<?php

namespace app\models;

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
}
