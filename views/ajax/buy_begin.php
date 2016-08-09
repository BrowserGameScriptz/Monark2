<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="buy-view-ajax">
	<?php $userTurn = $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php $landUser = $GameData[$land_id]->getGameDataUserId() == $User->getId(); ?>
	<?php if($landUser): ?>
		<?php if($userTurn): ?>
			<?php if($CurrentTurnData->getTurnGold() > 0): ?>
				<table class="list-spaced">
					<tr>
						<td id='td-show-units-def' style="padding: 4px;"><font size='4'><?= Yii::t('ajax', 'Text_Units'); ?> <?= $Land[$land_id]->getLandName() ?> : </font><font size='4'><?= $GameData[$land_id]->getGameDataUnits()." ".Yii::t('ajax', 'Text_Units_Pending')?></font></td>
					</tr>
					<tr>
						<td id="td-select_unit_number" style="padding: 4px;">
							<font size='4'><?= Yii::t('ajax', 'Text_Buy_To_Recruit'); ?> :</font>
							<input style="color: #C0C0C0;" type="number" id="input_select_unit_number" name="input_select_unit_number" 
							value=<?= "'".$CurrentTurnData->getTurnGold()."'" ?> min="0" 
							max=<?= "'".$CurrentTurnData->getTurnGold()."'" ?> >
						</td>
					</tr>
				</table>
				<div class="div-center">
						<?= "<a href='#StartBuy' class='buy_action_link' i='".$land_id."' style='text-decoration:none;'><div class='btn btn-success'><i class='fa fa-usd'></i> ".Yii::t('ajax', 'Button_Land_Buy')."</div></a>"; ?>
				</div>
			<?php else: ?>
				<div class="alert alert-danger" style="text-align:center;">
					<font size='3'>
						<?= Yii::t('ajax', 'Text_No_More_Money'); ?>
					</font>
				</div>
			<?php endif; ?>
		<?php else: ?>
			<div class="alert alert-danger" style="text-align:center;">
				<font size='3'>
					<?= Yii::t('ajax', 'Text_Not_User_Turn'); ?>
				</font>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', 'Text_Not_Owner'); ?>
			</font>
		</div>
	<?php endif; ?>
</div>