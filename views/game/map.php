<?php
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\web\View;
use app\models\Land;
use app\controllers\AjaxController;
use app\assets\AppAsset;
use app\models\Frontier;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Map');
$refresh_time = $this->context->refreshTime;

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);

// Call files
$this->registerJsFile("@web/js/game/map.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
$this->registerCssFile("@web/css/map.css");
?>

<div class="map-show">
	<!-- Modals Js -->
    <?php
        Modal::begin(['id' => 'modal-view','header' => '<div class="modal-header-title"></div>']);
        echo "<div id='modal-view-Content'></div>";
        Modal::end();
    ?>
    <!-- End Modal Js -->
	<?php Pjax::begin(['id' => 'map_content']); ?>
	<div id='map_content'>
		<?php $user_units = 0; ?>
		<?php $max_show_units = 20; ?>
		<?php foreach ($GameData as $data): ?>
			
			<?php $land = $Land[$data->getGameDataLandId()]; ?>  
			<div class="land_content" i=<?= "'".$land->getLandId()."'"; ?>>
				  <!-- Image -->
	              <a href=<?= "'#".str_replace("'", "-", $land->getLandName())."'"; ?> class="link_land_img" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;text-decoration: none;'"; ?>>
	                    <img src=<?= "'".$land->getLandImageTempUrl($Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorName2())."'"; ?> i=<?= "'".$land->getLandId()."'"; ?> alt=<?= '"'.$land->getLandName().'"'; ?> class="land_img" 
	                    style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>> 
	                    <!--<div class="building" style=<?= "'position:absolute;top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
	                        <?php //if($value['land_harbor']): ?>
	                            <img src='img/harbor.png' height='20px' width='20px' style='position:relative;top:24px;left:10px;'>
	                        <?php //endif; ?>
	                    </div>-->
	                </a>
	               <!-- Title -->
	               <div class="land_title" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
                        <font color=<?= "'".$Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorFontOther()."'"; ?>>
                         	<!-- <?= $land->getLandName(); ?> -->
                         	<?= $land->getLandName(); ?>
                         	<!--<?php if($data->getGameDataCapital() >= 1): ?>
	                        	<?= "<img src='img/game/star.png' height='20px' width='20px'>"; ?>
	                        -->
	                        <?php endif; ?>
	                        <!-- Land data -->   
                            <?php if($data->getGameDataResourceId() > 0 && $Resource[$data->getGameDataResourceId()]->getResourceImage() != ""): ?>
                                <?= "<img src='".$Resource[$data->getGameDataResourceId()]->getResourceImageUrl()."' height='20px' width='20px'>"; ?>
                            <?php endif; ?>
                         	<?php if(Frontier::userHaveFrontierLand($UserFrontier, $land->getLandId())): ?>
	                            <!-- Buildings -->
	                            <?php foreach($GameData[$land->getLandId()]->getGameDataBuildings() as $building): ?>
									<?php if($building != null && isset($Building[$building]) && $Building[$building]->getBuildingNeed() <= 0 && $Building[$building]->getBuildingId() > 0): ?>
										<?= $Building[$building]->getBuildingImg() ?>
						            <?php endif; ?>
						        <?php endforeach; ?>
                        		<!-- Units -->
                        		<?php if($data->getGameDataUnits() <= $max_show_units): ?>
			                     	<?= Land::LandCountUnitsToArrayShow($data->getGameDataUnits());?>
		                  		<?php else: ?>
		                  			<?= $data->getGameDataUnits(); ?>
		                  		<?php endif; ?>
	                  		<?php endif; ?>
	                  	</font>	
                  </div>
	        </div>
		<?php endforeach; ?>
	</div>
	<?php Pjax::end(); ?>
	 <nav id="context-menu" class="context-menu">
    <ul class="context-menu__items">
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="View"><i class="fa fa-eye"></i> View Task</a>
      </li>
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="Edit"><i class="fa fa-edit"></i> Edit Task</a>
      </li>
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="Delete"><i class="fa fa-times"></i> Delete Task</a>
      </li>
    </ul>
  </nav>
</div>
						