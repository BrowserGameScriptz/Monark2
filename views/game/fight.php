<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\classes\FightDataClass;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_History');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-news">       
    <?php $conquest = $FightData->getFightConquest() === 1;?>  
       
    <h1><?= Yii::t('game', 'Txt_Fight_Details'); ?></h1>   
    <h3 class="timeline-header" style="text-align:center;">
       <a href="#" style="text-decoration: none;"><font color="#<?= $Color[$GamePlayer[$FightData->getFightAtkUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= ($FightData->getFightAtkUserId() >= 0)?$Users[$FightData->getFightAtkUserId()]->getUserName():$Bots[$FightData->getFightAtkUserId()]->getUserName(); ?></font></a>
          <?php if ($conquest): ?>
             <?= Yii::t('game', 'Txt_History_Defeated'); ?>
          <?php else: ?>
              <?= Yii::t('game', 'Txt_History_Lost'); ?>
         <?php endif; ?>
         <a href="#" style="text-decoration: none;"><font color="#<?= $Color[$GamePlayer[$FightData->getFightDefUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= ($FightData->getFightDefUserId() >= 0)?$Users[$FightData->getFightDefUserId()]->getUserName():$Bots[$FightData->getFightDefUserId()]->getUserName(); ?></font></a>
                      
         <?php if ($conquest): ?>
            <?= Yii::t('game', 'Txt_History_Conquest'); ?> <font color="#<?= $Color[$GamePlayer[$FightData->getFightAtkUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>"><?= $Land[$FightData->getFightDefLandId()]->getLandName() ?></font>
         <?php endif; ?>                      
    </h3>      
    <table>
    	<tr><td style="text-align:center;"><h3 class="timeline-header">ATTAQUANT</h3></td><td style="text-align:center;"><h3 class="timeline-header">DEFENSEUR</h3></td></tr>
    	<tr><td style="width:50%;">
		    <div class="tab-content">
		         <div class="tab-pane active" id="timeline">
		            <ul class="timeline timeline-inverse">
		            	  <?php $atkRoundArray = FightDataClass::getFightThimbleToRoundArray($FightData->getFightThimbleAtk()); ?>
		                  <?php $atkUnitsArray = FightDataClass::getFightUnitsToRoundArray($FightData->getFightAtkUnits()); ?>
		                  <?php for($i = count($atkRoundArray); $i > 0; $i--): ?>
			                  <?php if(isset($atkRoundArray[$i]) && isset($atkUnitsArray[$i])): ?>
				                  <li>
				                  	<i class="fa fa-bolt bg-red"></i>  
				                    <div class="timeline-item">
				                    	<h3 class="timeline-header">
				                    	Units : <?= $atkUnitsArray[$i] ?>
				                    	</h3>
				                      	<h3 class="timeline-header">
				                      		<?php foreach (FightDataClass::getFightThimbleToThimbleArray($atkRoundArray[$i]) as $thimble): ?>
				                      			<?= $thimble; ?>
				                      		<?php endforeach; ?>	
				                      	</h3>
				                    </div>
				                  </li>
				              <?php endif; ?>
		                 <?php endfor; ?>                 
		           </ul>
		       </div>
			</div>
		</td>
		<td>
		    <div class="tab-content">
		         <div class="tab-pane active" id="timeline">
		            <ul class="timeline timeline-inverse">
		                 <?php $defRoundArray = FightDataClass::getFightThimbleToRoundArray($FightData->getFightThimbleDef()); ?>
		                 <?php $defUnitsArray = FightDataClass::getFightUnitsToRoundArray($FightData->getFightDefUnits()); ?>
		                  <?php for($i = count($defRoundArray); $i > 0; $i--): ?>
			                  <?php if(isset($defRoundArray[$i])): ?>
				                  <li>
				                  	<i class="fa fa-bolt bg-red"></i>  
				                    <div class="timeline-item">
				                      	<h3 class="timeline-header">
				                      		<?php foreach (FightDataClass::getFightThimbleToThimbleArray($defRoundArray[$i]) as $thimble): ?>
				                      			<?= $thimble; ?>
				                      		<?php endforeach; ?>	
				                      	</h3>
				                    </div>
				                  </li>
				              <?php endif; ?>
		                 <?php endfor; ?>                      
		           </ul>
		       </div>
			</div>
		</td></tr>
	</table>
</div>
