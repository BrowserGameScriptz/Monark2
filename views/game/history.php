<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use app\classes\DateClass;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_History');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-news">
	<h1><?= Html::encode($this->title) ?></h1>
             
    <div class="tab-content">
         <div class="tab-pane active" id="timeline">
            <ul class="timeline timeline-inverse">
                  
                  <?php foreach ($FightData as $fight): ?>
                  	  <?php $conquest = $fight->getFightConquest() === 1;?>
                  	  <?php $concerned = ($fight->getFightAtkUserId() == Yii::$app->session['User']->getUserID()) || ($fight->getFightDefUserId() == Yii::$app->session['User']->getUserID());?>
	                  <li>
	                    <i class="fa fa-bolt bg-red"></i>
	                    <div class="timeline-item">
	                      <span class="time">
	                      	<i class="fa fa-clock-o"></i> <?= (new DateClass($fight->getFightTime()))->showTimeElapsed(); ?>
	                      </span>
	                      
	                      <h3 class="timeline-header">
	                      <a href="#" style="text-decoration: none;"><font color="#<?= $Color[$GamePlayer[$fight->getFightAtkUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= $this->context->getGamePlayerName($fight->getFightAtkUserId(), $Users, $Bots) ?></font></a>
	                      <?php if ($conquest): ?>
	                      	<?= Yii::t('game', 'Txt_History_Defeated'); ?>
	                      <?php else: ?>
	                      	<?= Yii::t('game', 'Txt_History_Lost'); ?>
	                      <?php endif; ?>
	                      <a href="#" style="text-decoration: none;"><font color="#<?= $Color[$GamePlayer[$fight->getFightDefUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= $this->context->getGamePlayerName($fight->getFightDefUserId(), $Users, $Bots) ?></font></a>
	                      
	                      <?php if ($conquest): ?>
	                      	<?= Yii::t('game', 'Txt_History_Conquest'); ?> <font color="#<?= $Color[$GamePlayer[$fight->getFightAtkUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= $Land[$fight->getFightDefLandId()]->getLandName() ?></font>
	                      <?php endif; ?>
	                      
	                      <?php if($concerned): ?>
	                      	<?= Html::a("Details", ['game/fight', 'fi' => $fight->getFightId()], ['class'=>'btn btn-primary btn-xs']); ?>
	                      <?php endif; ?>
	                      </h3>
	                    </div>
	                  </li>
                  
                  <?php endforeach; ?>
                  
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
           </ul>
       </div>
	</div>
</div>
