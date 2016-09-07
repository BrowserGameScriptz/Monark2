<?php
use app\assets\AppAsset;
use yii\bootstrap\Progress;
$this->title = "Roll dice test";

$atk_result = array(
		'fight_nb' => 5,
		'conquest' => 1,
		'atk_engage_units' => 16,
		'atk_result_units' => 16,
		'def_engage_units' => 9,
		'def_result_units' => 0,
		"thimble_atk" => "/5;4;1;/6;4;4;/6;3;3;/6;5;4;/3;1;1;",
		"thimble_def" => "/4;2;/5;1;/3;2;/3;1;/2;",
		"atk_units" => "/16/16/16/16/16/16",
		"def_units" => "/9/7/5/3/1/0",
);

// Call files
$this->registerJsFile("@web/js/game/anim.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/fight.js", ['depends' => [AppAsset::className()]]);
$this->registerJs('$("document").ready(function(){showFight('.json_encode($atk_result).');});');
?>
		<?= Progress::widget([
			'id' => 'attack-action',
			'percent' => 0,
			'barOptions' => ['class' => 'progress-bar'],
		    'options' => ['class' => 'active progress-striped']
		]); ?>
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