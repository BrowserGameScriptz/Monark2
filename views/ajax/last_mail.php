<?php

use app\classes\StringClass;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<?php $i = 0; ?>
<?php foreach($lastMail as $mail): ?>
	<li><a href='#'>
	<?= $this->context->getGamePlayerName($mail->getMailUserSendId(), $UsersData, $BotData) ?> : <?= (new StringClass($mail->getMailSubject()))->getStringAbstract(10) ?></a></li>
	<?php $i++; ?>
<?php endforeach; ?>
<?php if($i == 0): ?>
	<li><a href='#'><?= Yii::t('header', 'Text_No_Unread_Mail') ?></a></li>
<?php endif; ?>