<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelDailyAttendance;

/**
 * AelDailyAttendanceSearch represents the model behind the search form about `app\models\AelDailyAttendance`.
 */
class AelDailyAttendanceSearch extends AelDailyAttendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'leave_id'], 'integer'],
            [['date', 'clock In', 'clock Out', 'status', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted'], 'safe'],
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
        $query = AelDailyAttendance::find();

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
            'user_id' => $this->user_id,
            'date' => $this->date,
            'clock_In' => $this->clock_In,
            'clock_Out' => $this->clock_Out,
            'leave_id' => $this->leave_id,
            'created_datetime' => $this->created_datetime,
            'updated_datetime' => $this->updated_datetime,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted]);

        return $dataProvider;
    }
}
