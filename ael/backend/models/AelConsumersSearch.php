<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AelUser;

/**
 * AelUserSearch represents the model behind the search form about `app\models\AelUser`.
 */
class AelConsumersSearch extends AelUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'user_type', 'supervisor_id'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password', 'password_reset_token', 'email', 'qr_code', 'first_name', 'first_name_chi', 'last_name', 'last_name_chi', 'gender', 'udid', 'gcm', 'user_email', 'user_mobile', 'mobile_type', 'is_active', 'is_deleted', 'user_lat', 'user_long', 'designation', 'designation_chi', 'address', 'address_chi','is_admin'], 'safe'],
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
        $query = AelUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'query' => AelUser::find()->joinWith(['aelusertype(aelusertype)'])->where(['=','aelusertype.id',id])
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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_type' => $this->user_type,
            'supervisor_id' => $this->supervisor_id,
            'is_admin' => 0,
            'user_type' => 4
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'qr_code', $this->qr_code])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'first_name_chi', $this->first_name_chi])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'last_name_chi', $this->last_name_chi])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'udid', $this->udid])
            ->andFilterWhere(['like', 'gcm', $this->gcm])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'user_mobile', $this->user_mobile])
            ->andFilterWhere(['like', 'mobile_type', $this->mobile_type])
            ->andFilterWhere(['like', 'is_active', $this->is_active])
            ->andFilterWhere(['like', 'is_deleted', $this->is_deleted])
            ->andFilterWhere(['like', 'user_lat', $this->user_lat])
            ->andFilterWhere(['like', 'user_long', $this->user_long])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'designation_chi', $this->designation_chi])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_chi', $this->address_chi]);
        

        return $dataProvider;
    }
}
