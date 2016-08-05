<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Loby');
?>

<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
    	'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => Yii::t('game', 'Tab_Game_Name'),
                'value'     => function ($model, $key, $index, $column) {
                    return $model->decryptGameName($model->game_name);
                },
            ],
            [
                'attribute' => Yii::t('game', 'Tab_Owner_Name'),
                'value'     => function ($model, $key, $index, $column) {
                    return $model->getUserOwner($model->game_owner_id)->getUserName();
                },
            ],
            [
	            'filter' => false,
	            'attribute' => Yii::t('game', 'Tab_Max_Player'),
	            'value'     => function ($model, $key, $index, $column) {
	           		return $model->getGameCountPlayer($model->game_id)." / ".$model->game_max_player;
	            },
            ],
            [
	            'filter' => false,
	            'attribute' => Yii::t('game', 'Tab_Create_Time'),
	            'value'     => function ($model, $key, $index, $column){
		            if(time() - $model->game_create_time <= 60){
		            	return Yii::t('game', 'Text_Second_{nb}', ['nb' => date('s', time() - $model->game_create_time)]);
		            }elseif(time() - $model->game_create_time <= 60*60){
		            	return Yii::t('game', 'Text_Min_{nb}', ['nb' => date('i', time() - $model->game_create_time)]);
		            }elseif(time() - $model->game_create_time <= 60*60*24){
		            	return Yii::t('game', 'Text_Hour_{nb}', ['nb' => date('H', time() - $model->game_create_time)]);
		            }elseif(time() - $model->game_create_time <= 60*60*24*2){
		            	return Yii::t('game', 'Text_Yesterday');
		            }elseif(time() - $model->game_create_time <= 60*60*24*7){
		            	return Yii::t('game', 'Text_Week');
		            }else{
		            	return date(Yii::t('game', 'Text_Date'), $model->game_create_time);
		            }
	            },
            ],
            [
            'filter' => false,
            'attribute' => Yii::t('game', 'Tab_Rejoin'),
            'format'    => 'raw',
            'value'     => function ($model, $key, $index, $column){
            	if($model->game_statut == 0){
            		//if(!isset($player_exist_game) OR $player_exist_game['quit'] <= 1){
            			return "<center><table style='border-collapse: separate;border-spacing: 5px;'><tr>"
            			."<td>".Html::a(Yii::t('game', 'Button_Game_Enter')." <i class='fa fa-sign-in'></i>", ['/game/join', 'gid' => $model->game_id], ['class'=>'btn btn-success'])."</td>"
            			."<td>".Html::a(Yii::t('game', 'Button_Game_Spec')." <i class='fa fa-eye'></i>", ['/game/spec', 'gid' => $model->game_id], ['class'=>'btn btn-primary'])."</td>"
            			."</tr></table></center>";
            		/*}else{
            			return "<center><div class='btn btn-danger'>".Yii::t('game', 'Button_Game_Ban')."</div></center>";
            		}*/
            	}elseif($model->game_statut >= 25){
            		return "<center>".Html::a(Yii::t('game', 'Button_Game_Return'), ['/game/join', 'gid' => $model->game_id], ['class'=>'btn btn-success'])."</center>";
            	}elseif($model->game_statut >= 25){
            		return "<center>".Html::a(Yii::t('game', 'Button_Game_Spec'), ['/game/spec', 'gid' => $model->game_id], ['class'=>'btn btn-primary'])."</center>";
            	}elseif($model->game_statut > 99){
            		return "<center>".Yii::t('game', 'Button_Game_End')."</center>";
            	}
            },
            ],
        ],
    ]); ?>

</div>
