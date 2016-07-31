<?php

use yii\helpers\Html;
use app\models\Land;
use app\models\Frontier;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="landinfo-view-ajax">
	<?php $land 		= $Land[$land_id]; ?>
	<?php $visible 		= Frontier::userHaveFrontierLand($UserFrontierData, $land_id);?>
	<?php $userTurn 	= $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php $buttonDisable = ($userTurn)? "" : " disabled"; ?>
	<?php $userLand 	= $GameData[$land_id]->getGameDataUserId() == $User->getId(); ?>
	<?php $landFrontier = Frontier::landHaveFrontierLandArray($FrontierData, $land_id) ?>
	<table class="table-no-style" style="width:100%;table-layout:fixed;">
		<tr style="width:100%;">
			<td style="width:60%;">
				<table id='details' class="table table-bordered table-hover">
		        <tbody>
		        	<!-- region info -->
					<tr>
						<td style="padding: 4px;text-align:center;"><font size='3' color="black">
						<?php if($GameData[$land_id]->getGameDataCapital() > 0): ?>
							<?= Html::tag('span', "<img src='img/game/star.png' height='20px' width='20px'>", [
		                        'title'=>"Capitale du joueur. ",
		                        'data-toggle'=>'tooltip',
		                        'data-placement' => 'auto',
		                        'style'=>'text-decoration: none; cursor:pointer;'
		                    ]); ?>
		                <?php endif; ?>
		                <?= $Land[$land_id]->getLandName() ?>
		                <?php if($Continent[$Land[$land_id]->getLandContinentId()]->getContinentId() != 0): ?>
		                	( <?= Yii::t('continent', $Continent[$Land[$land_id]->getLandContinentId()]->getContinentName()); ?> )
						<?php endif; ?>
						</font></td>
						<!--<td style="padding: 4px;"><?= Html::a("informations", ['/land/show', 'i' => $land_id], ['class'=>'btn btn-info']); ?></td>-->
					</tr>
					<!-- units info -->
					<?php if($visible): ?>
					<tr>
						<td style="padding: 4px;text-align:center;"><font size='3' color="black">
						<?php $land_units = Land::LandCountUnitsToArray($GameData[$land_id]->getGameDataUnits()); ?>
						<?= Html::tag('span', Yii::t('ajax', 'Text_Units')." :", [
					                          'title'=> $GameData[$land_id]->getGameDataUnits()." ".Yii::t('ajax', 'Text_Units'),
					                          'data-toggle'=>'tooltip',
					                          'data-placement' => 'auto',
					                          'style'=>'text-decoration: none; cursor:pointer;'
					            ]); ?>
	                     <?php for($i=1; $i <= $land_units['canon']; $i++): ?>
	                       	<img src='img/game/canon.png' class='land_canon' style=<?= "'left:".$i."px;'"; ?>>
	                   	<?php endfor; ?>
	                    <?php for($i=1; $i <= $land_units['horseman']; $i++): ?>
	                       	<img src='img/game/horseman.png' class='land_horseman' style=<?= "'left:".$i."px;'"; ?>>
	                    <?php endfor; ?>
	                    <?php for($i=1; $i <= $land_units['soldier']; $i++): ?>
	                    	<img src='img/game/soldier.png' class='land_soldier' style=<?= "'left:".$i."px;'"; ?>>
	                  	<?php endfor; ?>
						</font></td>
					</tr>
					<?php endif; ?>
					<!-- owner info -->
					<tr>
						<td style="padding: 4px;text-align:center;"><font size='3' color="black"> <?= Yii::t('ajax', 'Text_Owner'); ?> : </font><font size='4' color="#<?= $Color[$GamePlayer[$GameData[$land_id]->getGameDataUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>">
							<?php if($userLand): ?>
								<?= Yii::t('ajax', 'Text_Owner_Player'); ?>
							<?php else: ?>
							 	<?= $UsersData[$GameData[$land_id]->getGameDataUserId()]->getUserName(); ?>
							<?php endif; ?>
						</font></td>
					</tr>
					<!-- Resource info -->
					<tr>
						<td style="padding: 4px;text-align:center;"><font size='3' color="black">
						<?= Yii::t('ajax', 'Text_Resource'); ?> :
						 <?php if($GameData[$land_id]->getGameDataResourceId() > 0 && $Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceImage() != ""): ?>
	                         <?= Html::tag('span', "<img src='".$Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceImageUrl()."' height='20px' width='20px'>".$Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceName(), [
					                          'title'=> $Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceDescription(),
					                          'data-toggle'=>'tooltip',
					                          'data-placement' => 'auto',
					                          'style'=>'text-decoration: none; cursor:pointer;'
					            ]); ?>
	                    <?php else: ?>
	                    	<?= Yii::t('ajax', 'Text_Land_No_Resource'); ?>
	                    <?php endif; ?>
						</font></td>
					</tr>
					<!-- building info -->
					<?php if($visible): ?>
					<tr>
						<td style="padding: 4px;text-align:center;"><font size='3' color="black">
						<?php $i = 0; ?>
						<?php foreach($GameData[$land_id]->getGameDataBuildings() as $building): ?>
							<?php if($building != null && $BuildingData[$building]->getBuildingId() > 0): ?>
								<?= $BuildingData[$building]->getBuildingImg() ?>
								<?= Html::tag('span', $BuildingData[$building]->getBuildingName(), [
					                          'title'=> $BuildingData[$building]->getBuildingDescription(),
					                          'data-toggle'=>'tooltip',
					                          'data-placement' => 'auto',
					                          'style'=>'text-decoration: none; cursor:pointer;'
					            ]); ?>
					            <?php $i++; ?>
				            <?php endif; ?>
				        <?php endforeach; ?>
			            <?php if($i == 0): ?>
	                    	<?= Yii::t('ajax', 'Text_Land_No_Building'); ?>
	                    <?php endif; ?>
						</font></td>
					</tr>
					<?php endif; ?>
					<!-- frontiere info -->
					<tr>
						<td style="padding: 4px;text-align:center;"><font size='3'>
							<font color="black"><?= Yii::t('ajax', 'Text_Land_Frontier'); ?> : </font> <br>
							<?php foreach($landFrontier as $frontierLand): ?>
								<font size='3' color="#<?= $Color[$GamePlayer[$GameData[$frontierLand->getFrontierLandIdTwo()]->getGameDataUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>">
									<?= $Land[$frontierLand->getFrontierLandIdTwo()]->getLandName(); ?><br>
								</font>
							<?php endforeach; ?>
						</font></td>
					</tr>
				</tbody>
				</table>
			</td>
			<td style="width:40%;">
				<div class="div-center">
					<img src=<?= "'".$land->getLandImageTempUrl($Color[$GamePlayer[$GameData[$land_id]->getGameDataUserId()]->getGamePlayerColorId()]->getColorName2())."'"; ?> style="width:130%">
				</div>
			</td>
		</tr>
		<tr style="width:100%;">
			<td>
				<div class="div-center">
					<!-- Bottom buttons -->
					<table class="table-no-style" style="width:100%;">
					<tbody>
						<tr>
							<?php if($userLand): ?>
							<td>
								<?php ($buttonDisable == "")?$buy_link = "buy_link":$buy_link = ""; ?>
								<?= Html::tag('span', "&nbsp;<a href='#Buy' class='".$buy_link."' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success ".$buttonDisable."'><i class='fa fa-usd'></i> ".Yii::t('ajax', 'Button_Land_Buy')." </span></a>", [
				                    'title'=> Yii::t('ajax', "Buy units for this land."),
				                    'data-toggle'=>'tooltip',
				                    'data-placement' => 'bottom',
				                    'style'=>'text-decoration: none; cursor:pointer;'
				                ]); ?>
				            </td><td>
				            	<?php ($buttonDisable == "")?$build_link = "build_link":$build_link = ""; ?>
				                <?= Html::tag('span', "&nbsp;<a href='#Build' class='".$build_link."' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-primary".$buttonDisable."'><i class='fa fa-gavel'></i> ".Yii::t('ajax', 'Button_Land_Build')." </span></a>", [
				                    'title'=> Yii::t('ajax', "Construct buildings on the land: fort, camp, mines."),
				                    'data-toggle'=>'tooltip',
				                    'data-placement' => 'bottom',
				                    'style'=>'text-decoration: none; cursor:pointer;'
				                ]); ?>
				            </td>
				            <?php ($buttonDisable == "")?$move_link = "move_link":$move_link = ""; ?>
					            <?php if(isset($conquestAll[$land_id]) && $conquestAll[$land_id] == true): ?>
						            <td>
						                <?= Html::tag('span', "&nbsp;<a href='#Move' class='' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-warning disabled'><i class='fa fa-truck'></i> ".Yii::t('ajax', 'Button_Land_Move_Conquest')." </span></a>", [
						                    'title'=> Yii::t('ajax', "Move units to another land."),
						                    'data-toggle'=>'tooltip',
						                    'data-placement' => 'bottom',
						                    'style'=>'text-decoration: none; cursor:pointer;'
						                ]); ?>
							        </td>
							    <?php else : ?>
							    	<td>
						                <?= Html::tag('span', "&nbsp;<a href='#Move' class='".$move_link."' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-warning".$buttonDisable."'><i class='fa fa-truck'></i> ".Yii::t('ajax', 'Button_Land_Move')." </span></a>", [
						                    'title'=> Yii::t('ajax', "Move units to another land."),
						                    'data-toggle'=>'tooltip',
						                    'data-placement' => 'bottom',
						                    'style'=>'text-decoration: none; cursor:pointer;'
						                ]); ?>
							        </td>
						    	<?php endif; ?>
					        <?php elseif(!$userLand && $visible): ?>
					        <td>
					        	<?php ($buttonDisable == "")?$atk_link = "atk_link":$atk_link = ""; ?>
					        	<?= Html::tag('span', "&nbsp;<a href='#Buy' class='".$atk_link."' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-danger".$buttonDisable."'><i class='fa fa-bolt'></i> ".Yii::t('ajax', 'Button_Land_Atk')." </span></a>", [
					                    'title'=> Yii::t('ajax', "Attack this land."),
					                    'data-toggle'=>'tooltip',
					                    'data-placement' => 'bottom',
					                    'style'=>'text-decoration: none; cursor:pointer;'
					                ]); ?>
					        </td>
					        <?php endif; ?>
						</tr>
					</tbody>
					</table>
				</div>
			</td>
		</tr>
	</table>
	<div class="div-center">
		<?php if(!$userTurn): ?>
			<br><?= Yii::t('ajax', 'Text_Not_User_Turn'); ?>
		<?php endif; ?>
	</div>
</div>
