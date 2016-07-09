<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title =  Yii::t('game_player', 'Title_Lobby_{params}', ['params' => Yii::$app->session['Game']->getGameName()]);
?>

<div class="game-lobby">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <!-- Top Buttons -->
    <div style="margin: 0 auto;"><table style="border-spacing: 4px;border-collapse: separate;"><tr>
    <!-- Classic -->
    <td><?= Html::a(Yii::t('game_player', 'Button_Add_Friend')." <i class='fa fa-group'></i>", ['/game/lobby'], ['class'=>'btn btn-primary']); ?></td>
    <td><?= Html::a(Yii::t('game_player', 'Button_Rdy')." <i class='fa fa-check'></i>", ['/game/lobby'], ['class'=>'btn btn-success']); ?></td>
    <!-- Game Owner -->
    <td><?= Html::a(Yii::t('game_player', 'Button_Add_Bot')." <i class='fa fa-plus'></i>", ['/game/lobby'], ['class'=>'btn btn-info']); ?></td>
    <td><?= Html::a(Yii::t('game_player', 'Button_Sart_Game')." <i class='fa fa-gamepad'></i>", ['/game/lobby'], ['class'=>'btn btn-warning']); ?></td>
    </tr></table></div>
    <br>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
    	'tableOptions' => ['class' => 'table table-bordered table-hover'],
    	'rowOptions'=>function($model) use ($colorList) {
	    		return ['style' => 'background-color: #'.$colorList[$model->game_player_color_id]->getColorCSS()];
	    	},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
            	'format'    => 'raw',
                'attribute' => Yii::t('game_player', 'Tab_User_Name'),
                'value'     => function ($model, $key, $index, $column) use ($userList, $colorList) {
                	$returned = '<font size="4" color="'.$colorList[$model->game_player_color_id]->getColorFontChat().'">'.$userList[$model->game_player_user_id]->getUserName().'</font>  ';
                	if(Yii::$app->session['User']->getId() == Yii::$app->session['Game']->getGameOwnerID() && Yii::$app->session['User']->getId() != $model->game_player_user_id)
            			return $returned
    							.Html::a(" <i class='fa fa-sign-out'></i>", ['/game/lobby'], ['class'=>'btn btn-xs btn-danger']);
                	else
                		return $returned;
            	},
            ],
            [
            	'format'    => 'raw',
                'attribute' => Yii::t('game_player', 'Tab_Color_Name'),
                'value'     => function ($model, $key, $index, $column) use ($colorList, $colorSQl){
                	if(Yii::$app->session['User']->getId() == $model->game_player_user_id)
                		return Html::activeDropDownList($model, 'game_player_color_id',
                			ArrayHelper::map($colorSQl,
                				function($model, $defaultValue) {
                					return $model->color_id;
                				},
                				function($model, $defaultValue) {
                					return Yii::t('color_name', $model->color_name);
                				}
                				),
                				[
                						'prompt'	=> Yii::t('color_name', $colorList[$model->game_player_color_id]->getColorName()),
                						'class'		=> 'selectpicker',
                						'onchange'	=> 'location = "'.Url::current().'&ui='.$model->game_player_user_id.'&ci=+this.value";',
                				]);
                	else
                		return '<font size="4" color="'.$colorList[$model->game_player_color_id]->getColorFontChat().'">'.$colorList[$model->game_player_color_id]->getColorName().'</font>';
                },
            ],
            [
	            'filter' => false,
            	'format'    => 'raw',
	            'attribute' => Yii::t('game_player', 'Tab_Region_Player'),
	            'value'     => function ($model, $key, $index, $column) use ($continentList, $continentSQl, $colorList){
	            	if(Yii::$app->session['User']->getId() == $model->game_player_user_id)
	           			return Html::activeDropDownList($model, 'game_player_region_id',
	           				ArrayHelper::map($continentSQl,
	           					function($model, $defaultValue) {
	           						return $model->continent_id;
	           					},
	           					function($model, $defaultValue) {
	           						return Yii::t('continent_name', $model->continent_name);
	           					}
	           				),
	           				[
	           				'prompt'	=> Yii::t('continent_name', $continentList[$model->game_player_region_id]->getContinentName()),
	           				'class'		=> 'selectpicker',
	           				'onchange'	=> 'location = "'.Url::current().'&ui='.$model->game_player_user_id.'&ri=\'+this.value";',
		           		]);
	           		else
	           			return '<font size="4" color="'.$colorList[$model->game_player_color_id]->getColorFontChat().'">'.$continentList[$model->game_player_region_id]->getContinentName().'</font>';
	            },
            ],
        ],
    ]); ?>

</div>