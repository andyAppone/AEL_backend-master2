<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_user_type".
 *
 * @property integer $id
 * @property string $user_type
 * @property string $user_type_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 */
class AelUserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type','user_type_chi','is_active'], 'required'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            [['is_active','is_staff','is_deleted'], 'string'],
            [['user_type', 'user_type_chi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type' => 'User Type',
            'user_type_chi' => 'User Type Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
        ];
    }
    
    public function getMessageTrigger() {
        return $this->hasOne(AelUserType::className(), ['id' => 'user_type']);
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
