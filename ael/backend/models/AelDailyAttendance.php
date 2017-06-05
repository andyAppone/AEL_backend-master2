<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_daily_attendance".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $clock In
 * @property string $clock Out
 * @property string $status
 * @property integer $leave_id
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 */
class AelDailyAttendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_daily_attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'clock In', 'clock Out', 'status', 'leave_id', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted'], 'required'],
            [['user_id', 'leave_id'], 'integer'],
            [['date', 'clock In', 'clock Out', 'created_datetime', 'updated_datetime'], 'safe'],
            [['status', 'is_active', 'is_deleted'], 'string'],
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
            'date' => 'Date',
            'clock_In' => 'Clock  In',
            'clock_Out' => 'Clock  Out',
            'status' => 'Status',
            'leave_id' => 'Leave ID',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
