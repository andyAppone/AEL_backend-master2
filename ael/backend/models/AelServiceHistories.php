<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_service_histories".
 *
 * @property integer $id
 * @property integer $pm_e_call
 * @property string $qr_code
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
 * @property string $registered_datetime
 * @property string $schedule_start_datetime
 * @property string $schedule_end_datetime
 * @property string $actual_start_datetime
 * @property string $actual_end_datetime
 * @property string $customer_signature
 * @property string $service_checklist
 * @property string $status
 * @property string $reports
 * @property string $is_canceled
 * @property string $cancelation_reason
 * @property string $pm_reports_chi
 * @property string $report_status
 * @property string $service_type
 */
class AelServiceHistories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_service_histories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pm_e_call', 'lift_id', 'client_id', 'worker_1_id', 'worker_2_id', 'supervisor_id'], 'integer'],
            [['created_datetime', 'updated_datetime', 'registered_datetime', 'schedule_start_datetime', 'schedule_end_datetime', 'actual_start_datetime', 'actual_end_datetime'], 'safe'],
            [['is_active', 'is_deleted', 'status', 'reports', 'is_canceled', 'cancelation_reason', 'report_status', 'service_type'], 'string'],
            [['registered_datetime'], 'required'],
            [['qr_code', 'lift_name', 'lift_name_chi', 'customer_signature', 'service_checklist', 'pm_reports_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pm_e_call' => 'Pm E Call',
            'qr_code' => 'Qr Code',
            'lift_name' => 'Lift Name',
            'lift_name_chi' => 'Lift Name Chi',
            'lift_id' => 'Lift ID',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'client_id' => 'Client ID',
            'worker_1_id' => 'Worker 1 ID',
            'worker_2_id' => 'Worker 2 ID',
            'supervisor_id' => 'Supervisor ID',
            'registered_datetime' => 'Registered Datetime',
            'schedule_start_datetime' => 'Schedule Start Datetime',
            'schedule_end_datetime' => 'Schedule End Datetime',
            'actual_start_datetime' => 'Actual Start Datetime',
            'actual_end_datetime' => 'Actual End Datetime',
            'customer_signature' => 'Customer Signature',
            'service_checklist' => 'Service Checklist',
            'status' => 'Status',
            'reports' => 'Reports',
            'is_canceled' => 'Is Canceled',
            'cancelation_reason' => 'Cancelation Reason',
            'pm_reports_chi' => 'Pm Reports Chi',
            'report_status' => 'Report Status',
            'service_type' => 'Service Type',
        ];
    }
}
