<?php

use yii\bootstrap\Progress;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<script type="text/javascript">
<?php print '$("document").ready(function(){showFight(('.json_encode($atk_result).'));});'; ?>
</script>
<div class="atk-action-view-ajax">
	<?php if($error === true): ?>
	
		<?= Progress::widget([
			'id' => 'attack-action',
			'percent' => 0,
			'barOptions' => ['class' => 'progress-bar'],
		    'options' => ['class' => 'active progress-striped']
		]); ?>
		<!--<div class="div-center">
			<?= "<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-plus'></i> ".Yii::t('ajax', 'Text_Build_Other')." </span></a>"; ?>
		</div>-->
		<div id='fight-atk' style="width: 100%; margin: 0 auto;">
			<table style="width: 100%">
				<tr>
					<td style="text-align:center;width: 50%;"><?= Yii::t('ajax', 'Text_Victory') ?> : <span id='win_percent_atk'>
					<?php if($atk_result["conquest"] == 1): ?>  0 <?php else: ?> 0 <?php endif; ?></span>%</td>
					<td style="text-align:center;width: 50%;"><?= Yii::t('ajax', 'Text_Victory') ?> : <span id='win_percent_def'>
					<?php if($atk_result["conquest"] == 1): ?>  0 <?php else: ?> 0 <?php endif; ?></span>%</td>
				</tr>
				<tr>
					<td style="text-align:center;width: 50%;"><?= Yii::t('ajax', 'Text_Attacker') ?> : <span id='units_atk'><?= $atk_result["atk_result_units"]; ?>
					( - <?= ($atk_result["atk_engage_units"] - $atk_result["atk_result_units"]); ?>)</span></td>
					<td style="text-align:center;width: 50%;"><?= Yii::t('ajax', 'Text_Defender') ?> : <span id='units_def'><?= $atk_result["def_result_units"]; ?> 
					( - <?= ($atk_result["def_engage_units"] - $atk_result["def_result_units"]); ?>)</span></td>
				</tr>
				<tr>
					<td style="text-align:center;width: 50%; margin: 0 auto;">
						<table style="width: 100%"><tr>
						<td style="width: 20%;"><div id="die-atk-1" class="dice"></div></td>
						<td style="width: 20%;"><div id="die-atk-2" class="dice"></div></td>
						<td style="width: 20%;"><div id="die-atk-3" class="dice"></div></td>
						<td style="width: 20%;"><div id="die-atk-4" class="dice"></div></td>
						</tr></table>
					</td>
					
					<td style="text-align:center;width: 50%; margin: 0 auto;">
						<table style="width: 100%"><tr>
						<td style="width: 33%;"><div id="die-def-1" class="dice"></div></td>
						<td style="width: 33%;"><div id="die-def-2" class="dice"></div></td>
						<td style="width: 33%;"><div id="die-def-3" class="dice"></div></td>
						</tr></table>
					</td>
				</tr>
			</table>
		</div>	
		<br><br><br><br>	
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', $error); ?>
			</font>
		</div>
		<div class="div-center">
			<?= "<a href='#Atk' class='atk_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-arrow-left'></i> ".Yii::t('ajax', 'Button_Return')." </span></a>"; ?>
		</div>
	<?php endif; ?>
</div>