<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UserSearch represents the model behind the search form about `app\models\Users`.
 */
class UserSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_registration_time', 'user_last_login', 'user_role', 'user_type'], 'integer'],
            [['user_name', 'user_mail', 'user_ip', 'user_key', 'user_authKey', 'user_accessToken', 'user_pwd', 'user_pwd2'], 'safe'],
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
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'user_registration_time' => $this->user_registration_time,
            'user_last_login' => $this->user_last_login,
            'user_role' => $this->user_role,
            'user_type' => $this->user_type,
        ]);

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'user_mail', $this->user_mail])
            ->andFilterWhere(['like', 'user_ip', $this->user_ip])
            ->andFilterWhere(['like', 'user_key', $this->user_key])
            ->andFilterWhere(['like', 'user_authKey', $this->user_authKey])
            ->andFilterWhere(['like', 'user_accessToken', $this->user_accessToken])
            ->andFilterWhere(['like', 'user_pwd', $this->user_pwd])
            ->andFilterWhere(['like', 'user_pwd2', $this->user_pwd2]);

        return $dataProvider;
    }
}
