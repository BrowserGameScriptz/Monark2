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
    $gameid = Yii::$app->session['game']['id'];
    $gold   = 10;
    $bot_id = -1;
    ?>

    <?= "<center><font size='6'>Simulation de BOT ".$bot_id."</font><br>" ?>
    <?= "<font size='5'>Or : ".$gold."<br>Partie id : ".$gameid."</font></center><font size='6'>Réponse : </font><br><br>" ?>

    <div class='alert alert-danger'>

    <?php $Bot = new Bot(); ?>

    <?php $Bot->BotStartTurn($gameid, $bot_id, $gold, 1); ?>

    </div>


</div>