<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="build-action-view-ajax">
	<?php if($error === true): ?>
		construction terminée
		<div class="div-center">
			<?= "<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-plus'></i> ".Yii::t('ajax', 'Text_Build_Other')." </span></a>"; ?>
		</div>
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', $error); ?>
			</font>
		</div>
		<div class="div-center">
			<?= "<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-arrow-left'></i> ".Yii::t('ajax', 'Button_Return')." </span></a>"; ?>
		</div>
	<?php endif; ?>
</div>