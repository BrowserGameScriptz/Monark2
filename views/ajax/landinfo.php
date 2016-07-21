<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */

?>
<div class="landinfo-view-ajax">
	<?php $land = $Land[$land_id]; ?>
	<div id='details' style='display:block;'>
		<table class="table table-striped table-bordered">
	        <tbody>
				<tr>
					<!-- region info -->
					<td style="padding: 4px;text-align:center;"><font size='3'>Nom de la region : </font></td>
					<td style="padding: 4px;text-align:center;"><font size='3'>
					<?php if($GameData[$land_id]->getGameDataCapital() > 0): ?> 
						<?= Html::tag('span', "<img src='img/star.png' height='20px' width='20px'>", [
	                        'title'=>"Capitale du joueur. ",
	                        'data-toggle'=>'tooltip',
	                        'data-placement' => 'auto',
	                        'style'=>'text-decoration: none; cursor:pointer;'
	                    ]); ?>
	                <?php endif; ?>
					</font></td>
					<!--<td style="padding: 4px;"><?= Html::a("informations", ['/land/show', 'i' => $land_id], ['class'=>'btn btn-info']); ?></td>-->
				</tr>
			</tbody>
		</table>
	</div>

	<div id="buttons" class="div-center">
		<!--<span id='onclick' class='btn btn-info'>Détails</span>-->
		<!-- Bottom buttons -->	
		<?php if($CurrentTurnData->getTurnUserId() == $User->getId()): ?>
				<?= Html::tag('span', "&nbsp;<a href='#Buy' class='buy_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-usd'></i> Acheter </span></a>", [
                    'title'=>"Acheter des troupes pour cette région.",
                    'data-toggle'=>'tooltip',
                    'data-placement' => 'bottom',
                    'style'=>'text-decoration: none; cursor:pointer;'
                ]); ?>
                <?= Html::tag('span', "&nbsp;<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-info'><i class='fa fa-gavel'></i> Construire </span></a>", [
                    'title'=>"Construire des bétiments sur la région : fort, camp, mines. ",
                    'data-toggle'=>'tooltip',
                    'data-placement' => 'bottom',
                    'style'=>'text-decoration: none; cursor:pointer;'
                ]); ?>
		<?php else: ?>
			Aucune action disponible <br> Veuillez attendre votre tour...
		<?php endif; ?>
	</div>	
</div>
