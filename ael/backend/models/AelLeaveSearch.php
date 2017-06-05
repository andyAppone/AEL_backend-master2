<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelLeave;

/**
 * AelLeaveSearch represents the model behind the search form about `app\models\AelLeave`.
 */
class AelLeaveSearch extends AelLeave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'action_user_id'], 'integer'],
            [['leave_start_date', 'leave_start_time', 'leave_end_date', 'leave_end_time', 'leave_desc', 'status', 'leave_type', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted', 'cancellation _reason'], 'safe'],
            [['total_leave_days'], 'number'],
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
        $query = AelLeave::find();

        // add conditions that should always apply here
        
        $this->load($params);

        $query = (new \yii\db\Query())
                ->select("al.*,au.first_name as fullname")
                ->from('ael_leave as al')
                ->join('LEFT JOIN','ael_user AS au','au.id = al.user_id');     
        

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
            'user_id' => $this->user_id,
            'leave_start_date' => $this->leave_start_date,
            'leave_start_time' => $this->leave_start_time,
            'leave_end_date' => $this->leave_end_date,
            'leave_end_time' => $this->leave_end_time,
            'created_datetime' => $this->created_datetime,
            'updated_datetime' => $this->updated_datetime,
            'total_leave_days' => $this->total_leave_days,
            'action_user_id' => $this->action_user_id,
        ]);

        $query->andFilterWhere(['like', 'leave_desc', $this->leave_desc])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'leave_type', $this->leave_type])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'cancellation_reason', $this->cancellation_reason]);

        return $dataProvider;
    }
}
