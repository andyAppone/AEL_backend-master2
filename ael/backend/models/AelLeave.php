<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_leave".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $leave_start_date
 * @property string $leave_start_time
 * @property string $leave_end_date
 * @property string $leave_end_time
 * @property string $leave_desc
 * @property string $status
 * @property string $leave_type
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property double $total_leave_days
 * @property integer $action_user_id
 * @property string $cancellation _reason
 */
class AelLeave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'leave_start_date', 'leave_end_date', 'status', 'leave_type', 'is_active', 'total_leave_days'], 'required'],
            [['user_id', 'action_user_id'], 'integer'],
            [['leave_start_date', 'leave_start_time', 'leave_end_date', 'leave_end_time', 'created_datetime', 'updated_datetime'], 'safe'],
            [['status', 'leave_type', 'is_active', 'is_deleted'], 'string'],
            [['total_leave_days'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'leave_start_date' => 'Leave Start Date',
            'leave_start_time' => 'Leave Start Time',
            'leave_end_date' => 'Leave End Date',
            'leave_end_time' => 'Leave End Time',
            'leave_desc' => 'Leave Desc',
            'status' => 'Status',
            'leave_type' => 'Leave Type',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'total_leave_days' => 'Total Leave Days',
            'action_user_id' => 'Action User ID',
            'cancellation _reason' => 'Cancellation  Reason',
        ];
    }
}
