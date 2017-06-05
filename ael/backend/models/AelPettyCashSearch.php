<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelPettyCash;

/**
 * AelPettyCashSearch represents the model behind the search form about `app\models\AelPettyCash`.
 */
class AelPettyCashSearch extends AelPettyCash
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lift_name', 'lift_name_chi', 'lift_id', 'service_id'], 'integer'],
            [['staff_id','updated_datetime','created_datetime'], 'safe'],
            [['amount_fare', 'amount_ot', 'amount_extra'], 'number'],
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
        $query = AelPettyCash::find();

        // add conditions that should always apply here
        
        $this->load($params);
        $created =  date("Y-m-d",strtotime($this->created_datetime));
        $updated =  date("Y-m-d",strtotime($this->updated_datetime));
        $staffName = $this->staff_id;
        $where = '1';
        if($this->created_datetime!='' && $this->updated_datetime!='') {
            $where.= " AND ( date(apc.petty_cash_date) BETWEEN '".$created."' AND '".$updated."') ";
        }
        if($staffName !='') {
            $where.= ' AND ( au.first_name LIKE "'.$staffName.'" OR  au.last_name LIKE "'.$staffName.'" ) ';
        }
        $query = (new \yii\db\Query())
                ->select("apc.*,au.first_name,au.last_name")
                ->from('ael_petty_cash as apc')
                ->join('LEFT JOIN','ael_user AS au','au.id = apc.staff_id')
                ->where($where);
        
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
            'lift_name' => $this->lift_name,
            'lift_name_chi' => $this->lift_name_chi,
            'lift_id' => $this->lift_id,
            'service_id' => $this->service_id,
            'amount_fare' => $this->amount_fare,
            'amount_ot' => $this->amount_ot,
            'amount_extra' => $this->amount_extra,
            'petty_cash_date' => $this->petty_cash_date,
        ]);

        $query->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'service_type', $this->service_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'is_paid', $this->is_paid]);

        return $dataProvider;
    }
}
