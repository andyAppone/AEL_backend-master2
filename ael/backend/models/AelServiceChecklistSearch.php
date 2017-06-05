<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelServiceChecklist;

/**
 * AelServiceChecklistSearch represents the model behind the search form about `app\models\AelServiceChecklist`.
 */
class AelServiceChecklistSearch extends AelServiceChecklist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['lift_checklist_details', 'lift_checklist_details_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted', 'lift_checklist_type', 'lift_checklist_expected_result'], 'safe'],
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
        $query = AelServiceChecklist::find();

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

        $query->andFilterWhere(['like', 'lift_checklist_details', $this->lift_checklist_details])
            ->andFilterWhere(['like', 'lift_checklist_details_chi', $this->lift_checklist_details_chi])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'lift_checklist_type', $this->lift_checklist_type])
            ->andFilterWhere(['like', 'lift_checklist_expected_result', $this->lift_checklist_expected_result]);

        return $dataProvider;
    }
}
