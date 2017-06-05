<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "ael_petty_cash".
 *
 * @property integer $id
 * @property integer $lift_name
 * @property integer $lift_name_chi
 * @property integer $lift_id
 * @property integer $staff_id
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property string $service_type
 * @property integer $service_id
 * @property double $amount_fare
 * @property double $amount_ot
 * @property double $amount_extra
 * @property string $petty_cash_date
 * @property string $status
 * @property string $is_paid
 */
class AelPettyCash extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_petty_cash';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount_fare', 'amount_ot', 'amount_extra', 'petty_cash_date', 'status', 'is_paid'], 'required'],
            [['created_datetime', 'updated_datetime', 'petty_cash_date'], 'safe'],
            [['is_active', 'is_deleted', 'status', 'is_paid'], 'string'],
            [['amount_fare', 'amount_ot', 'amount_extra'], 'number'],
            [['service_type'], 'string', 'max' => 10],
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
            'lift_id' => 'Lift ID',
            'staff_id' => 'Staff ID',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'service_type' => 'Service Type',
            'service_id' => 'Service ID',
            'amount_fare' => 'Amount Fare',
            'amount_ot' => 'Amount Ot',
            'amount_extra' => 'Amount Extra',
            'petty_cash_date' => 'Petty Cash Date',
            'status' => 'Status',
            'is_paid' => 'Paid Status',
        ];
    }
}
