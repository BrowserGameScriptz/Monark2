<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\classes\FightDataClass;
use app\models\Land;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Fight_Details');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-news">       
    <?php $conquest = $FightData->getFightConquest() === 1;?>  
       
    <h1><?= $this->title; ?></h1>   
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
    <?php $atkRoundArray = FightDataClass::getFightThimbleToRoundArray($FightData->getFightThimbleAtk()); ?>
	<?php $atkUnitsArray = FightDataClass::getFightUnitsToRoundArray($FightData->getFightAtkUnits()); ?>                  
    <?php $defRoundArray = FightDataClass::getFightThimbleToRoundArray($FightData->getFightThimbleDef()); ?>
	<?php $defUnitsArray = FightDataClass::getFightUnitsToRoundArray($FightData->getFightDefUnits()); ?>	                  
    	
    <div class="col-lg-5" style="text-align:center;">
    	<h3 class="timeline-header"><?= Yii::t('game', 'Txt_Fight_Attacker'); ?> (- <?= $FightData->getFightAtkLostUnit(); ?>)</h3>
    	<div class="tab-content">
		    <div class="tab-pane active" id="timeline">
	            <ul class="timeline timeline-inverse">
	            	  <?php for($i = count($atkRoundArray); $i > 0; $i--): ?>
	                  <?php if(isset($atkRoundArray[$i]) && isset($atkUnitsArray[$i])): ?>
		                  <li>
		                  	<?php if(isset($atkUnitsArray[$i+1]) && isset($defUnitsArray[$i+1]) && (($defUnitsArray[$i] - $defUnitsArray[$i+1]) > ($atkUnitsArray[$i] - $atkUnitsArray[$i+1]))):  ?>
		                  		<i class="fa fa-bolt bg-green"></i>
		                  	<?php elseif(isset($atkUnitsArray[$i+1]) && isset($defUnitsArray[$i+1]) && (($defUnitsArray[$i] - $defUnitsArray[$i+1]) == ($atkUnitsArray[$i] - $atkUnitsArray[$i+1]))): ?>  
		                  		<i class="fa fa-bolt bg-orange"></i>
		                  	<?php else: ?>  
		                  		<i class="fa fa-bolt bg-red"></i>
		                  	<?php endif; ?>  
		                    <div class="timeline-item">
		                    	<h3 class="timeline-header">&nbsp;
		                      		<span style="float:left;">
			                      		<?php foreach (FightDataClass::getFightThimbleToThimbleArray($atkRoundArray[$i]) as $thimble): ?>
			                      			<?php if($thimble != null): ?>
			                      				<img src='img/de/de_<?= $thimble; ?>.png' width='20px'>
			                      			<?php endif; ?>
			                      		<?php endforeach; ?>
		                      		</span>
		                      		<span style="float:right;">
			                      		<?= Land::LandCountUnitsToArrayShow($atkUnitsArray[$i]); ?>
				                      	<?php if(isset($atkUnitsArray[$i+1]) && ($atkUnitsArray[$i] - $atkUnitsArray[$i+1]) > 0): ?>
				                      		- <?= Land::LandCountUnitsToArrayShow(($atkUnitsArray[$i] - $atkUnitsArray[$i+1])); ?>
				                      	<?php endif; ?>
		                      		</span>
		                      	</h3>
		                    </div>
		                  </li>
		              <?php endif; ?>
	                 <?php endfor; ?>                 
		           </ul>
		       </div>
		</div>
	</div>
	<div class="col-lg-5" style="text-align:center;">
		<h3 class="timeline-header"><?= Yii::t('game', 'Txt_Fight_Defender'); ?> (- <?= $FightData->getFightDefLostUnit(); ?>)</h3>
	    <div class="tab-content">
	         <div class="tab-pane active" id="timeline">
	            <ul class="timeline timeline-inverse">
	                  <?php for($i = count($defRoundArray); $i > 0; $i--): ?>
		                  <?php if(isset($defRoundArray[$i]) && isset($defUnitsArray[$i])): ?>
			                  <li>
			                  	<?php if(isset($atkUnitsArray[$i+1]) && isset($defUnitsArray[$i+1]) && (($defUnitsArray[$i] - $defUnitsArray[$i+1]) < ($atkUnitsArray[$i] - $atkUnitsArray[$i+1]))):  ?>
			                  		<i class="fa fa-bolt bg-green"></i>
			                  	<?php elseif(isset($atkUnitsArray[$i+1]) && isset($defUnitsArray[$i+1]) && (($defUnitsArray[$i] - $defUnitsArray[$i+1]) == ($atkUnitsArray[$i] - $atkUnitsArray[$i+1]))): ?>  
			                  		<i class="fa fa-bolt bg-orange"></i>
			                  	<?php else: ?>  
			                  		<i class="fa fa-bolt bg-red"></i>
			                  	<?php endif; ?>    
			                    <div class="timeline-item">
			                      	<h3 class="timeline-header">&nbsp;
			                      		<span style="float:left;"> 
				                      		<?php foreach (FightDataClass::getFightThimbleToThimbleArray($defRoundArray[$i]) as $thimble): ?>
				                      			<?php if($thimble != null): ?>
			                      					<img src='img/de/de_<?= $thimble; ?>.png' width='20px'>
			                      				<?php endif; ?>
				                      		<?php endforeach; ?>
			                      		</span>
		                      			<span style="float:right;">	
				                      		<?= Land::LandCountUnitsToArrayShow($defUnitsArray[$i]); ?>
				                      		<?php if(isset($defUnitsArray[$i+1]) && ($defUnitsArray[$i] - $defUnitsArray[$i+1]) > 0): ?>
				                      		- <?= Land::LandCountUnitsToArrayShow(($defUnitsArray[$i] - $defUnitsArray[$i+1])); ?>
				                      		<?php endif; ?>
			                      		</span>
			                      	</h3>
			                    </div>
			                  </li>
			              <?php endif; ?>
	                 <?php endfor; ?>                      
	           </ul>
	       </div>
		</div>
	</div>
</div>
