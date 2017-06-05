<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "ael_messages".
 *
 * @property integer $id
 * @property string $message_title
 * @property string $message_title_chi
 * @property string $message_desc
 * @property string $message_desc_chi
 * @property string $message_attach
 * @property string $message_attach_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property string $message_target_audience
 */
class AelMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $message_attach;
    //public $message_attach_chi;
    public static function tableName()
    {
        return 'ael_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        //'message_attach', 'message_attach_chi',
        return [
            [['message_title','message_title_chi','message_desc','message_desc_chi', 'is_active','message_target_audience'], 'required','on' => 'create'],
            [['message_title','message_title_chi','message_desc','message_desc_chi', 'is_active','message_target_audience'], 'required','on' => 'update'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            [['message_attach','message_attach_chi'], 'file','skipOnEmpty' => false, 'extensions' => 'png, jpg','on' => 'create','checkExtensionByMimeType'=>false],
            [['message_attach','message_attach_chi'], 'file','skipOnEmpty' => true, 'extensions' => 'png, jpg','on' => 'update','checkExtensionByMimeType'=>false],
            [['is_active', 'is_deleted', 'message_target_audience'], 'string'],
            //[['message_title', 'message_title_chi', 'message_desc', 'message_desc_chi', 'message_attach', 'message_attach_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_title' => 'Message Title',
            'message_title_chi' => 'Message Title Chi',
            'message_desc' => 'Message Desc',
            'message_desc_chi' => 'Message Desc Chi',
            'message_attach' => 'Message Attach',
            'message_attach_chi' => 'Message Attach Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
            'message_target_audience' => 'Message Target Audience',
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
