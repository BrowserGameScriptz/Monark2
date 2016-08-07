<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\bot\Bot;

/* @var $this yii\web\View */
/* @var $searchModel app\search\LandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Bot';
?>
<div class="TestBot-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <?php 
    $game_id = Yii::$app->session['Game']->getGameId();
    $bot_id = -1;
    ?>

    <?= "<center><font size='6'>Simulation de BOT ".$bot_id."</font><br>" ?>
    <?= "<font size='5'>Partie id : ".$game_id."</font></center><font size='6'>Réponse : </font><br><br>" ?>

    <div class='alert alert-danger'>

    <?php $Bot = new Bot($game_id, $bot_id, 1); ?>

    </div>


</div>