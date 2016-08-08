<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Diplomacy');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-diplomacy">
	<h1><?= Html::encode($this->title) ?></h1>
    <div class="box">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table">
                <tbody><tr>
                  <th><?= Yii::t('game', 'Txt_Diplomacy_Table_User') ?></th>
                  <th><?= Yii::t('game', 'Txt_Diplomacy_Table_Progress') ?></th>
                  <th><?= Yii::t('game', 'Txt_Diplomacy_Table_Status') ?></th>
                </tr>
                <?php foreach ($GamePlayer as $player): ?>
                	<?php if($player->getGamePlayerUserId() != 0 && $player->getGamePlayerUserId() != Yii::$app->session['User']->getUserID()): ?>
		                <?php $status = rand(5, 95); ?>
		                <?php 
		                	if($status < 30){
		                		$statusColor = "success";
		                		$statusName = Yii::t('game', 'Txt_Diplomacy_Status_Peace');
		                	}
		                	elseif($status < 60){
		                		$statusColor = "warning";
		                		$statusName = Yii::t('game', 'Txt_Diplomacy_Status_Tension');
		                	}
		                	else{
		                		$statusColor = "danger";
		                		$statusName = Yii::t('game', 'Txt_Diplomacy_Status_War');
		                	}
		                ?>
		                <tr>
		                  <td><a href="#" style="text-decoration: none;"><font size='4' color="#<?= $Color[$GamePlayer[$player->getGamePlayerUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= ($player->getGamePlayerUserId() >= 0)?$Users[$player->getGamePlayerUserId()]->getUserName():$Bots[$player->getGamePlayerUserId()]->getUserName(); ?></font></a></td>
		                  <td>
		                    <div class="progress progress">
		                      <div class="progress-bar progress-bar-<?= $statusColor; ?>" style="width: <?= $status; ?>%"></div>
		                    </div>
		                  </td>
		                  <td><span class="alert alert-<?= $statusColor; ?>">
		                  	<?= $statusName ?>
              			  </span></td>
		                </tr>
		           <?php endif; ?>
	            <?php endforeach; ?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
</div>
