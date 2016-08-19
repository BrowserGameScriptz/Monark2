<?php

namespace app\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GamePlayer;

/**
 * GamePlayerSearch represents the model behind the search form about `app\models\GamePlayer`.
 */
class GamePlayerSearch extends GamePlayer
{
	
	public function __construct($game_id){
		$this->game_player_game_id = $game_id;
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_player_id', 'game_player_region_id', 'game_player_difficulty_id', 'game_player_statut', 'game_player_game_id', 'game_player_user_id', 'game_player_color_id', 'game_player_enter_time', 'game_player_order', 'game_player_bot', 'game_player_quit'], 'integer'],
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
        $query = GamePlayer::find();

        $dataProvider = new ActiveDataProvider([
        		'query' => $query,
        		'sort' =>
        		['defaultOrder' =>
        				['game_player_enter_time' => SORT_ASC,]
        		],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'game_player_id' => $this->game_player_id,
            'game_player_region_id' => $this->game_player_region_id,
            'game_player_difficulty_id' => $this->game_player_difficulty_id,
            'game_player_statut' => $this->game_player_statut,
            'game_player_game_id' => $this->game_player_game_id,
            'game_player_user_id' => $this->game_player_user_id,
            'game_player_color_id' => $this->game_player_color_id,
            'game_player_enter_time' => $this->game_player_enter_time,
            'game_player_order' => $this->game_player_order,
            'game_player_bot' => $this->game_player_bot,
            'game_player_quit' => 0,
        ]);

        return $dataProvider;
    }
}
