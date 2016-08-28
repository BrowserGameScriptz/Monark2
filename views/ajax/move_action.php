<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="buy-action-view-ajax">
	<?php if($error === true): ?>
		troupes déplacées
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', $error); ?>
			</font>
		</div>
		<div class="div-center">
			<?= "<a href='#Move' class='move_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-arrow-left'></i> ".Yii::t('ajax', 'Button_Return')." </span></a>"; ?>
		</div>
	<?php endif; ?>
</div>