<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelLift;

/**
 * AelLiftSearch represents the model behind the search form about `app\models\AelLift`.
 */
class AelLiftSearch extends AelLift
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'last_pm_details'], 'integer'],
            [['lift_name', 'lift_name_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted', 'lift_qr_code', 'lift_brand', 'lift_address', 'lift_address_chi', 'lift_installation_date', 'lift_lat', 'lift_long'], 'safe'],
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
        $query = AelLift::find();

        // add conditions that should always apply here

        /*$dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);*/

        $this->load($params);
        
        
        $this->load($params);

        $query = (new \yii\db\Query())
                ->select("alp.*,au.first_name")
                ->from('ael_lift as alp')
                ->join('LEFT JOIN','ael_user AS au','alp.client_id = au.id');     
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => 'id'
        ]);
        

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
            'client_id' => $this->client_id,
            'last_pm_details' => $this->last_pm_details,
            'lift_installation_date' => $this->lift_installation_date,
        ]);

        $query->andFilterWhere(['like', 'lift_name', $this->lift_name])
            ->andFilterWhere(['like', 'lift_name_chi', $this->lift_name_chi])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'lift_qr_code', $this->lift_qr_code])
            ->andFilterWhere(['like', 'lift_brand', $this->lift_brand])
            ->andFilterWhere(['like', 'lift_address', $this->lift_address])
            ->andFilterWhere(['like', 'lift_address_chi', $this->lift_address_chi])
            ->andFilterWhere(['like', 'lift_lat', $this->lift_lat])
            ->andFilterWhere(['like', 'lift_long', $this->lift_long]);

        return $dataProvider;
    }
}
