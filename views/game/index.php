<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use app\assets\AppAsset;
use app\models\GamePlayer;
use yii\widgets\ActiveForm;
use app\classes\DateClass;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Loby');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<?php $userWasInGameId = GamePlayer::userIsInGameId($userGamePlayerData); ?>

<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if($userWasInGameId != null): ?>
    	<div class="callout callout-info">
    		<?= Yii::t('game', 'Error_User_Already_In_Game') ?>
	    	<?= Html::a("<p class='btn btn-success'>".Yii::t('game', 'Button_Last_Game_Enter')."</p>", ['/game/join', 'gid' => $userWasInGameId], ['style' => "text-decoration: none;"]);?>
	    	<?= Html::a("<p class='btn btn-warning'>".Yii::t('game', 'Button_Games_Quit')."</p>", ['/game/clean'], ['style' => "text-decoration: none;"]);?>
    	</div>
    <?php else: ?>
    	<br>
    <?php endif; ?>
    
    <?php if(isset($model->errors["Game"])): ?>
    	<div class='alert alert-danger'><?= $model->errors["Game"][0] ?></div>
    <?php endif;?>
    
    <?= Html::checkbox('agree', true, ['label' => Yii::t('game', 'Txt_Show_Started_Game')]); ?>
    <?= Html::checkbox('agree', true, ['label' => Yii::t('game', 'Txt_Show_Ended_Game')]); ?>
    
    <?php $form = ActiveForm::begin (['id' => 'join-form']);?>
    
    <?php Pjax::begin(['id' => 'list_game']); ?>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
    	'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => Yii::t('game', 'Tab_Game_Name'),
            	'format'    => 'raw',
                'value'     => function ($model, $key, $index, $column) use ($DifficultyData){
                    $returned 	= $model->decryptGameName($model->game_name);
                    $stars 		= "";
                    for($i=0; $i < $model->game_difficulty_id; $i++)
                    	$stars .= " <i class='fa fa-star'></i>";
                    return $returned.Html::tag('span', $stars, [
                    		'title'=> $DifficultyData[$model->game_difficulty_id]->getDifficultyName(),
                    		'data-toggle'=>'tooltip',
                    		'data-placement' => 'auto',
                    		'style'=>'text-decoration: none; cursor:pointer;'
                    ]);;
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
	            'attribute' => Yii::t('game', 'Tab_Map'),
	            'value'     => function ($model, $key, $index, $column) use ($mapData){
	            return $mapData[$model->game_map_id]->getMapName();
	            },
            ],
            [
	            'filter' => false,
	            'attribute' => Yii::t('game', 'Tab_Create_Time'),
	            'value'     => function ($model, $key, $index, $column){
		            return (new DateClass($model->game_create_time))->showTimeElapsed();
	            },
            ],
            [
            'filter' => false,
            'attribute' => Yii::t('game', 'Tab_Rejoin'),
            'format'    => 'raw',
            'value'     => function ($model, $key, $index, $column){
            	// TODO refactoring
            	if($model->game_statut == 0){
            		//if(!isset($player_exist_game) OR $player_exist_game['quit'] <= 1){
            			return "<center><table style='border-collapse: separate;border-spacing: 5px;'><tr>"
            			."<td>".Html::a(Yii::t('game', 'Button_Game_Enter')." <i class='fa fa-sign-in'></i>", ['/game/join', 'gid' => $model->game_id], ['data-method' => 'post','data-params' => 'myParam=anyValue','class'=>'btn btn-success'])."</td>"
            			."<td>".Html::a(Yii::t('game', 'Button_Game_Spec')." <i class='fa fa-eye'></i>", ['/game/spec', 'gid' => $model->game_id], ['data-method' => 'post','data-params' => 'myParam=anyValue','class'=>'btn btn-primary'])."</td>"
            			."</tr></table></center>";
            		/*}else{
            			return "<center><div class='btn btn-danger'>".Yii::t('game', 'Button_Game_Ban')."</div></center>";
            		}*/
            	}elseif($model->game_statut >= 25 && isset($userGamePlayerData[$model->game_id])){
            		return "<center>".Html::a(Yii::t('game', 'Button_Map_Enter')." <i class='fa fa-sign-in'></i>", ['/game/join', 'gid' => $model->game_id], ['data-method' => 'post','data-params' => 'myParam=anyValue','class'=>'btn btn-success'])."</center>";
            	}elseif($model->game_statut >= 25){
            		return "<center>".Html::a(Yii::t('game', 'Button_Game_Spec')." <i class='fa fa-eye'></i>", ['/game/spec', 'gid' => $model->game_id], ['data-method' => 'post','data-params' => 'myParam=anyValue','class'=>'btn btn-primary'])."</center>";
            	}elseif($model->game_statut > 99){
            		return "<center>".Yii::t('game', 'Button_Game_End')."</center>";
            	}
            },
            ],
        ],
    ]); ?>
	<?php Pjax::end(); ?>
    <?php ActiveForm::end(); ?>
</div>
