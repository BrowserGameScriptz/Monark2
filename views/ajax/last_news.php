<?php

use app\models\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<?php $i = 0; ?>
<?php foreach($lastNews as $news): ?>
	<li><a href='#'>
	<?= $alertType[$news->getAlertTypeId()]->getAlertTypeMessage(Alert::getParameter($alertType[$news->getAlertTypeId()]->getAlertTypeParameter(), $news->getAlertParameter(), $Land)) ?></a></li>
	<?php $i++; ?>
<?php endforeach; ?>
<?php if($i == 0): ?>
	<li><a href='#'><?= Yii::t('header', 'Text_No_Unread_News') ?></a></li>
<?php endif; ?>