<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_service_checklist".
 *
 * @property integer $id
 * @property string $lift_checklist_details
 * @property string $lift_checklist_details_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property string $lift_checklist_type
 * @property string $lift_checklist_expected_result
 */
class AelServiceChecklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_service_checklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lift_checklist_details','lift_checklist_details_chi','is_active','lift_checklist_type', 'lift_checklist_expected_result'], 'required'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            [['is_active', 'is_deleted', 'lift_checklist_type', 'lift_checklist_expected_result'], 'string'],
            [['lift_checklist_details', 'lift_checklist_details_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lift_checklist_details' => 'Lift Checklist Details',
            'lift_checklist_details_chi' => 'Lift Checklist Details Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'lift_checklist_type' => 'Lift Checklist Type',
            'lift_checklist_expected_result' => 'Lift Checklist Expected Result',
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
