<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_lift_pm".
 *
 * @property integer $id
 * @property string $pm_qr_code
 * @property string $lift_name
 * @property string $lift_name_chi
 * @property integer $lift_id
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $client_id
 * @property integer $worker_1_id
 * @property integer $worker_2_id
 * @property integer $supervisor_id
 * @property string $pm_schedule _start_datetime
 * @property string $pm_schedule _end_datetime
 * @property string $pm_actual_start_datetime
 * @property string $pm_actual_end_datetime
 * @property string $pm_customer signature
 * @property string $pm_service checklist
 * @property string $pm_status
 * @property string $pm_reports
 * @property string $is_canceled
 * @property string $Cancelation reason
 * @property string $pm_reports_chi
 * @property string $report_status
 */
class AelEcall extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['lift_id','ecall_launch_datetime','ecall_service_checklist','ecall_status', 'client_id', 'worker_1_id', 'worker_2_id', 'supervisor_id'], 'required'],
            //[['id', 'lift_id', 'client_id', 'worker_1_id', 'worker_2_id', 'supervisor_id'], 'integer'],,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ecall_qr_code' => 'Ecall Qr Code',
            'lift_name' => 'Lift Name',
            'lift_name_chi' => 'Lift Name Chi',
            'lift_id' => 'Lift',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
            'client_id' => 'Client',
            'worker_1_id' => 'Worker',
            'worker_2_id' => 'Engineer',
            'supervisor_id' => 'Supervisor',
            'pm_schedule_start_datetime' => 'PM Start Time',
            'pm_schedule_end_datetime' => 'PM End Time',
            'pm_actual_start_datetime' => 'PM Start Time',
            'pm_actual_end_datetime' => 'PM End Time',
            'pm_customer signature' => 'Pm Customer Signature',
            'pm_service checklist' => 'Checklist',
            'pm_status' => 'Pm Status',
            'pm_reports' => 'Pm Reports',
            'is_canceled' => 'Is Canceled',
            'Cancelation reason' => 'Cancelation Reason',
            'pm_reports_chi' => 'Pm Reports Chi',
            'report_status' => 'Report Status',
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
