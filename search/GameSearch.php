<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Game;

/**
 * GameSearch represents the model behind the search form about `app\models\Game`.
 */
class GameSearch extends Game
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'game_owner_id', 'game_max_player', 'game_create_time', 'game_statut', 'game_map_id', 'game_mod_id', 'game_turn_time', 'game_difficulty_id', 'game_won_user_id', 'game_won_time'], 'integer'],
            [['game_name', 'game_pwd', 'game_key'], 'safe'],
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
        $query = Game::find();
        $query->where('game_statut < 50');
        $dataProvider = new ActiveDataProvider([
        		'query' => $query,
        		'pagination' => ['pageSize' => 9,],
        		'sort' =>
        		['defaultOrder' =>
        				['game_create_time' => SORT_DESC,]
        		],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->andFilterWhere([
        	'game_name' => $this->game_name,
        	'game_pwd' => $this->game_pwd,
        	'game_key' => $this->game_key,
        	'game_id' => $this->game_id,
            'game_owner_id' => $this->game_owner_id,
            'game_max_player' => $this->game_max_player,
            'game_create_time' => $this->game_create_time,
            'game_statut' => $this->game_statut,
            'game_map_id' => $this->game_map_id,
            'game_mod_id' => $this->game_mod_id,
            'game_turn_time' => $this->game_turn_time,
            'game_difficulty_id' => $this->game_difficulty_id,
            'game_won_user_id' => $this->game_won_user_id,
            'game_won_time' => $this->game_won_time,
        ]);

        return $dataProvider;
    }
}
