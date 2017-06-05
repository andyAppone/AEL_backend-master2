<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelMessages;

/**
 * AelMessagesSearch represents the model behind the search form about `app\models\AelMessages`.
 */
class AelMessagesSearch extends AelMessages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['message_title', 'message_title_chi', 'message_desc', 'message_desc_chi', 'message_attach', 'message_attach_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted', 'message_target_audience'], 'safe'],
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
        $query = AelMessages::find();

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

        $query->andFilterWhere(['like', 'message_title', $this->message_title])
            ->andFilterWhere(['like', 'message_title_chi', $this->message_title_chi])
            ->andFilterWhere(['like', 'message_desc', $this->message_desc])
            ->andFilterWhere(['like', 'message_desc_chi', $this->message_desc_chi])
            ->andFilterWhere(['like', 'message_attach', $this->message_attach])
            ->andFilterWhere(['like', 'message_attach_chi', $this->message_attach_chi])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'message_target_audience', $this->message_target_audience]);

        return $dataProvider;
    }
}
