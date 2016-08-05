<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<?php foreach($lastBuy as $buy): ?>
	<li><a href='#'>-
	<?php if($buy->getBuyBuildId() > 0): ?>
		<?= $BuildingData[$buy->getBuyBuildId()]->getBuildingCost(); ?><i class="fa fa-usd"></i> (
		<?= $BuildingData[$buy->getBuyBuildId()]->getBuildingName(); ?>
	<?php else: ?>
		<?= $buy->getBuyUnitsNb() ?><i class="fa fa-usd"></i> (
		<?= Yii::t('ajax', 'Text_Units') ?>
	<?php endif; ?>
	
	<?= Yii::t('ajax', 'Text_In')." ".$Land[$buy->getBuyLandId()]->getLandName(); ?>)</a></li>
<?php endforeach; ?>