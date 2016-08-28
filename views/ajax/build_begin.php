<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="build-view-ajax">
	<?php $userTurn 	= $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php $landUser 	= $GameData[$land_id]->getGameDataUserId() == $User->getId(); ?>
	<?php if($landUser): ?>
	<?php $toBuildArray = $GameData[$land_id]->getGameDataBuildingsToBuild($GameData[$land_id]->getGameDataResourceId(), $BuildingData); ?>
		<?php if($userTurn): ?>
			<?php if($CurrentTurnData->getTurnGold() > 0): ?>
				<table class="table-no-style" style="width:100%;table-layout: auto;">
					<tr>
						<td><font size='4'> <?= Yii::t('ajax', 'Text_Resource_In_Land'); ?> <?= $Land[$land_id]->getLandName() ?> : </font>
						<font size='3' color="black">
							 <?php if($GameData[$land_id]->getGameDataResourceId() > 0 && $Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceImage() != ""): ?>
		                         <?= $Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceImageUrl().$Resource[$GameData[$land_id]->getGameDataResourceId()]->getResourceName(); ?>
		                    <?php else: ?>
		                    	<?= Yii::t('ajax', 'Text_Land_No_Resource'); ?>
		                    <?php endif; ?>
						</font></td>
					</tr>
					<tr>
						<td>
							<table>
								<tr>
									<td style="padding: 4px;"><font size='4'><?= Yii::t('ajax', 'Text_Build_In_Land'); ?> <?= $Land[$land_id]->getLandName() ?> : </font></td>
									<?php $i = 0; ?>
									<?php foreach($GameData[$land_id]->getGameDataBuildings() as $building): ?>
										<?php if($building != null && $BuildingData[$building]->getBuildingId() > 0): ?>
											<td style="padding: 4px;"><font size='3' color="black">
													<?= $BuildingData[$building]->getBuildingImg() ?>
													<?= Html::tag('span', $BuildingData[$building]->getBuildingName(), [
										                          'title'=> $BuildingData[$building]->getBuildingDescription(),
										                          'data-toggle'=>'tooltip',
										                          'data-placement' => 'auto',
										                          'style'=>'text-decoration: none; cursor:pointer;'
										            ]); ?>
								            <?php $i++; ?>
								            </font></td>
							            <?php endif; ?>
							        <?php endforeach; ?>
						            <?php if($i == 0): ?>
				                    	<td style="padding: 4px;text-align:center;"><font size='3' color="black"><?= Yii::t('ajax', 'Text_Land_No_Building'); ?></font></td>
				                    <?php endif; ?>
				              </tr>
						</table>
					</tr>
					<tr>
						<td>
						<table style="text-align:center;">
								<tr>
									<td style="padding: 4px;"><font size='4'><?= Yii::t('ajax', 'Text_Build_Able_Land'); ?> <?= $Land[$land_id]->getLandName() ?> : </font></td>
								</tr>
								<?php $i = 0; ?>
								<?php foreach($toBuildArray as $building): ?>
									<?php if($building->getBuildingId() > 0): ?>
										<tr><td><font size='3' color="black">
												<?= $building->getBuildingImg() ?>
												<?= Html::tag('span', $building->getBuildingName()." (".$building->getBuildingCost()." <i class='fa fa-usd'></i>)", [
									                          'title'=> $building->getBuildingDescription(),
									                          'data-toggle'=>'tooltip',
									                          'data-placement' => 'auto',
									                          'style'=>'text-decoration: none; cursor:pointer;'
									            ]); ?></font></td><td><font size='3' color="black">
										            <?= "<a href='#StartBuild' class='build_action_link btn btn-success' i='".$land_id."' building_i='".$building->getBuildingId()."' style='text-decoration:none;'>
													<i class='fa fa-gavel'></i> ".Yii::t('ajax', 'Button_Land_Build')." ".$building->getBuildingName()." </a>"; ?> 
								            <?php $i++; ?>    
								       	</font></td></tr>
						            <?php endif; ?>
					        	<?php endforeach; ?>
					            <?php if($i == 0): ?>
			                    	<tr><td style="padding: 4px;text-align:center;"><font size='3' color="black"><?= Yii::t('ajax', 'Text_Land_Nothing_To_Build'); ?></font></td></tr>
			                    <?php endif; ?>
						</table>
					</tr>
				</table>
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