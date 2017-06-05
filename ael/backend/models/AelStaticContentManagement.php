<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_static_content_management".
 *
 * @property integer $id
 * @property string $content_title
 * @property string $content_title_chi
 * @property string $content_desc
 * @property string $content_desc_chi
 * @property string $content_attach
 * @property string $content_attach_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 */
class AelStaticContentManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_static_content_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_title', 'content_title_chi', 'content_desc', 'content_desc_chi', 'content_attach', 'content_attach_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted'], 'required'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            [['is_active', 'is_deleted'], 'string'],
            [['content_title', 'content_title_chi', 'content_desc', 'content_desc_chi', 'content_attach', 'content_attach_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_title' => 'Content Title',
            'content_title_chi' => 'Content Title Chi',
            'content_desc' => 'Content Desc',
            'content_desc_chi' => 'Content Desc Chi',
            'content_attach' => 'Content Attach',
            'content_attach_chi' => 'Content Attach Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
