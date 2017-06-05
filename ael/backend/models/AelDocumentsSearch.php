<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelDocuments;

/**
 * AelDocumentsSearch represents the model behind the search form about `app\models\AelDocuments`.
 */
class AelDocumentsSearch extends AelDocuments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doc_category'], 'integer'],
            [['doc_title', 'doc_title_chi', 'doc_desc', 'doc_desc_chi', 'doc_attach', 'doc_attach_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted'], 'safe'],
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
        $query = AelDocuments::find();

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
            'doc_category' => $this->doc_category,
        ]);

        $query->andFilterWhere(['like', 'doc_title', $this->doc_title])
            ->andFilterWhere(['like', 'doc_title_chi', $this->doc_title_chi])
            ->andFilterWhere(['like', 'doc_desc', $this->doc_desc])
            ->andFilterWhere(['like', 'doc_desc_chi', $this->doc_desc_chi])
            ->andFilterWhere(['like', 'doc_attach', $this->doc_attach])
            ->andFilterWhere(['like', 'doc_attach_chi', $this->doc_attach_chi])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
