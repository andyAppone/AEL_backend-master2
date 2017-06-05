<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelStaticContentManagement;

/**
 * AelStaticContentManagementSearch represents the model behind the search form about `app\models\AelStaticContentManagement`.
 */
class AelStaticContentManagementSearch extends AelStaticContentManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['content_title', 'content_title_chi', 'content_desc', 'content_desc_chi', 'content_attach', 'content_attach_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AelStaticContentManagement::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_datetime' => $this->created_datetime,
            'updated_datetime' => $this->updated_datetime,
        ]);

        $query->andFilterWhere(['like', 'content_title', $this->content_title])
            ->andFilterWhere(['like', 'content_title_chi', $this->content_title_chi])
            ->andFilterWhere(['like', 'content_desc', $this->content_desc])
            ->andFilterWhere(['like', 'content_desc_chi', $this->content_desc_chi])
            ->andFilterWhere(['like', 'content_attach', $this->content_attach])
            ->andFilterWhere(['like', 'content_attach_chi', $this->content_attach_chi])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
