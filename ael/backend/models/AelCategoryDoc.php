<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ael_category_doc".
 *
 * @property integer $id
 * @property string $category_name
 * @property string $category_name_chi
 * @property string $created_datetime
 * @property string $updated_datetime
 * @property string $is_active
 * @property string $is_deleted
 */
class AelCategoryDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ael_category_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'category_name_chi','is_active'], 'required'],
            [['created_datetime', 'updated_datetime'], 'safe'],
            //[['is_active', 'is_deleted'], 'string'],
            //[['category_name', 'category_name_chi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'category_name_chi' => 'Category Name Chi',
            'created_datetime' => 'Created Datetime',
            'updated_datetime' => 'Updated Datetime',
            'is_active' => 'Status',
            'is_deleted' => 'Is Deleted',
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
