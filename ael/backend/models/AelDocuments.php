<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "ael_documents".
 *
 * @property integer $id
 * @property string $doc_title
 * @property string $doc_title_chi
 * @property string $doc_desc
 * @property string $doc_desc_chi
 * @property string $doc_attach
 * @property string $doc_attach_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 * @property integer $doc_category
 */
class AelDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_title', 'doc_title_chi', 'doc_desc', 'doc_desc_chi', 'is_active','doc_category'], 'required'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            [['is_active', 'is_deleted'], 'string'],
            [['doc_category'], 'integer'],
            [['doc_attach','doc_attach_chi'], 'file','skipOnEmpty' => false, 'extensions' => 'pdf, jpg','on' => 'create','checkExtensionByMimeType'=>false],
            [['doc_attach','doc_attach_chi'], 'file','skipOnEmpty' => true, 'extensions' => 'pdf, jpg','on' => 'update','checkExtensionByMimeType'=>false],
            //[['doc_title', 'doc_title_chi', 'doc_desc', 'doc_desc_chi', 'doc_attach', 'doc_attach_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_title' => 'Doc Title',
            'doc_title_chi' => 'Doc Title Chi',
            'doc_desc' => 'Doc Desc',
            'doc_desc_chi' => 'Doc Desc Chi',
            'doc_attach' => 'Doc Attach',
            'doc_attach_chi' => 'Doc Attach Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
            'doc_category' => 'Doc Category',
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
