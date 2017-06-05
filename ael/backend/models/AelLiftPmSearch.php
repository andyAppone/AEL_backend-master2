<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelLiftPm;

/**
 * AelLiftPmSearch represents the model behind the search form about `app\models\AelLiftPm`.
 */
class AelLiftPmSearch extends AelLiftPm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lift_id', 'client_id', 'worker_1_id', 'worker_2_id', 'supervisor_id'], 'integer'],
            [['pm_qr_code', 'lift_name', 'lift_name_chi', 'created_datetime', 'updated_datetime', 'is_active', 'is_deleted', 'pm_schedule _start_datetime', 'pm_schedule _end_datetime', 'pm_actual_start_datetime', 'pm_actual_end_datetime', 'pm_customer signature', 'pm_service checklist', 'pm_status', 'pm_reports', 'is_canceled', 'Cancelation reason', 'pm_reports_chi', 'report_status'], 'safe'],
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
        $query = AelLiftPm::find();
        $this->load($params);
        // add conditions that should always apply here
        $liftname = $this->lift_name;
        $qrCode = $this->pm_qr_code;
        
        
        $query = (new \yii\db\Query())
                ->select("alp.id,,alp.updated_datetime,alp.pm_schedule_start_datetime,alp.pm_qr_code,al.lift_name,au.first_name as client,au1.first_name as supervisor,au2.first_name as worker,au3.first_name as enginner,asc.lift_checklist_details")
                ->from('ael_lift_pm as alp')
                ->join('LEFT JOIN','ael_lift AS al','al.id = alp.lift_id')
                ->join('LEFT JOIN','ael_user AS au','au.id = alp.client_id')
                ->join('LEFT JOIN','ael_user AS au1','au1.id = alp.supervisor_id')
                ->join('LEFT JOIN','ael_user AS au2','au2.id = alp.worker_1_id')
                ->join('LEFT JOIN','ael_user AS au3','au3.id = alp.worker_2_id')
                ->join('LEFT JOIN','ael_service_checklist AS asc','asc.id = alp.pm_service_checklist');     
        

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
            'lift_id' => $this->lift_id,
            'created_datetime' => $this->created_datetime,
            'updated_datetime' => $this->updated_datetime,
            'client_id' => $this->client_id,
            'worker_1_id' => $this->worker_1_id,
            'worker_2_id' => $this->worker_2_id,
            'supervisor_id' => $this->supervisor_id,
            'pm_schedule _start_datetime' => $this->pm_schedule_start_datetime,
            'pm_schedule _end_datetime' => $this->pm_schedule_end_datetime,
            'pm_actual_start_datetime' => $this->pm_actual_start_datetime,
            'pm_actual_end_datetime' => $this->pm_actual_end_datetime,
        ]);

        $query->andFilterWhere(['like', 'lift_name_chi', $this->lift_name_chi])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'pm_customer_signature', $this->pm_customer_signature])
            ->andFilterWhere(['like', 'pm_service_checklist', $this->pm_service_checklist])
            ->andFilterWhere(['like', 'pm_status', $this->pm_status])
            ->andFilterWhere(['like', 'pm_reports', $this->pm_reports])
            ->andFilterWhere(['like', 'is_canceled', $this->is_canceled])
            ->andFilterWhere(['like', 'Cancelation_reason', $this->Cancelation_reason])
            ->andFilterWhere(['like', 'pm_reports_chi', $this->pm_reports_chi])
            ->andFilterWhere(['like', 'report_status', $this->report_status])
            ->andFilterWhere(['like', 'alp.pm_qr_code', $this->pm_qr_code])
            ->andFilterWhere(['like', 'al.lift_name', $this->lift_name]);
        

        return $dataProvider;
    }
}
