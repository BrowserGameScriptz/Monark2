<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<div class="sendchat-action-view-ajax">
	<?php if($error === true): ?>
		message envoy�
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', $error); ?>
			</font>
		</div>
	<?php endif; ?>
</div>