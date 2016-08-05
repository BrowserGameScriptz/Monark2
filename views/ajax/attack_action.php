<?php

use yii\bootstrap\Progress;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<div class="atk-action-view-ajax">
	<?php if($error === true): ?>
	
		<?= Progress::widget([
			'id' => 'attack-action',
			'percent' => 0,
			'label' => '0%',
			'barOptions' => ['class' => 'progress-bar'],
		    'options' => ['class' => 'active progress-striped']
		]); ?>
		<!--<div class="div-center">
			<?= "<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-plus'></i> ".Yii::t('ajax', 'Text_Build_Other')." </span></a>"; ?>
		</div>-->
		<div id='fight-div'>
			<table>
				<tr>
					<td><?= Yii::t('ajax', 'Text_Victory') ?> : <span id='win_percent'>
					<?php if($atk_result["conquest"] == 1): ?>  100 <?php else: ?> 0 <?php endif; ?></span>%</td>
				</tr>
				<tr>
					<td><?= Yii::t('ajax', 'Text_Attacker') ?> : <span id='units_atk'><?= $atk_result["atk_result_units"]; ?>
					( - <?= ($atk_result["atk_engage_units"] - $atk_result["atk_result_units"]); ?>)</span></td>
				</tr>
				<tr>
					<td><?= Yii::t('ajax', 'Text_Defender') ?> : <span id='units_def'><?= $atk_result["def_result_units"]; ?> 
					( - <?= ($atk_result["def_engage_units"] - $atk_result["def_result_units"]); ?>)</span></td>
				</tr>
			</table>
		</div>
		<script>
		// Show a round
					function showRound(i, percent, total_time, progress_name, fight_die_atk_array, fight_die_def_array, fight_units_atk_array, fight_units_def_array){					
    				// Round information
    				var round_fight_units_atk	= fight_units_atk_array[i];
					var round_fight_units_def 	= fight_units_def_array[i];

            		if(fight_die_atk_array[i] != null && fight_die_def_array[i] != null){
	            		var round_array_die_atk 	= fight_die_atk_array[i].split(";");
						var round_array_die_def 	= fight_die_def_array[i].split(";");			
					}

					// Change units					
					showUnits(round_fight_units_atk, round_fight_units_def);

					// Change probabilty to win
					updateChanceWin(round_fight_units_atk, round_fight_units_def);

					// Show end
					if(i == total_time){
    					showEnd(i, fight_units_atk_array, fight_units_def_array, progress_name);
    				}

					// Change progress
    				if(i <= total_time) {
    					updateProgress(progress_name, i, percent);
    					return 0;
    				} else {
    					return 1;
    				}
    			}

    			// Update Units
    			function showUnits(round_fight_units_atk, round_fight_units_def){
    				$("#units_atk").html(round_fight_units_atk);
					$("#units_def").html(round_fight_units_def);
    			}

    			// Update Progress Bar
    			function updateProgress(progress_name, i, percent){
    				var current = i * percent;
    				$("#"+progress_name+" .progress-bar").attr("style", "width:"+current+"%");
					$("#"+progress_name+" .progress-bar").attr("aria-valuenow", current);
					$("#"+progress_name+" .progress-bar").html(current+"%");
    			}

    			// Update Chance of Win
    			function updateChanceWin(round_fight_units_atk, round_fight_units_def){
    				if((round_fight_units_atk - round_fight_units_def) > 0){
    					var percent = 100-(Math.round((round_fight_units_atk + round_fight_units_def) / (round_fight_units_atk - round_fight_units_def)));
    				}else{
    					var percent = 100-(Math.round(-(round_fight_units_atk + round_fight_units_def) / (round_fight_units_atk - round_fight_units_def)));
    				}
    				$("#win_percent").html(percent);
    			}

    			function showEnd(i, fight_units_atk_array, fight_units_def_array, progress_name){
    				// Attack win
    				if(fight_units_atk_array[i+1] > 0){
    					var result = "Vous avez gagné ! ("+fight_units_atk_array[i]+")<br> Restantes : "+fight_units_atk_array[i+1]+" <br> Vos pertes : "+(fight_units_atk_array[1] - fight_units_atk_array[i+1])+" <br> Pertes adv : "+(fight_units_def_array[1]);
    				}else{
    					var result = "Vous avez perdu ! <br> Restantes : "+fight_units_def_array[i+1]+" <br> Vos pertes : "+(fight_units_atk_array[1])+" <br> Pertes adv : "+(fight_units_def_array[1] - fight_units_def_array[i+1]);
    				}

    				$("#fight-div").html(result);
    			}

    			// Start all functions
				$("document").ready(
					function(){
						// Informations 
	    				var i 						= 1;
	    				var total_time 				= <?= $atk_result["fight_nb"] ?>;
	    				var percent 				= 1;
	    				var progress_name 			= "attack-action";
	    				var fight_die_atk 			= "<?= $atk_result["thimble_atk"] ?>";
	    				var fight_die_def 			= "<?= $atk_result["thimble_def"] ?>";
	    				var fight_units_atk 		= "<?= $atk_result["atk_units"] ?>";
	    				var fight_units_def 		= "<?= $atk_result["def_units"] ?>";
	    				var fight_die_atk_array 	= fight_die_atk.split("/");
						var fight_die_def_array 	= fight_die_def.split("/");
						var fight_units_atk_array 	= fight_units_atk.split("/");
						var	fight_units_def_array 	= fight_units_def.split("/");
        				
        				// Interval beginning
    					var IntervalId = setInterval(
    						function(){
    							var returned = showRound(i, percent, total_time, progress_name, fight_die_atk_array, fight_die_def_array, fight_units_atk_array, fight_units_def_array);
	                			i++;
	                			if(returned == 1){
	                				clearInterval(IntervalId);
	                			}
    						}
                		, 1000); 
				    }
				);
		</script>		
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