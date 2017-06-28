<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Rank');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);

$n = 1;
?>

<div class="game-news">
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="tab-content">  
	     <?php foreach($rankData as $key => $rank): ?>
			<div class="box box-default">
				<div class="box-header with-border">
					<span class="btn btn-circle btn-<?php if($n == 1){print "success";}elseif($n == count($rankData)){print "danger";}elseif($n < 4){print "primary";}else{print "warning";}?> "><?= $n ?></span>
					<div class="div-center"><h3><font color="#<?= $Color[$GamePlayer[$key]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= $this->context->getGamePlayerName($key, $Users, $Bots) ?></font></h3></div>
				</div>
				<div class="box-body">Points : <?= $rank ?></div>
			</div>        
            <?php $n++; ?>        
	     <?php endforeach; ?>
	</div>
</div>