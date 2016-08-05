<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<?php $i = 0; ?>
<?php foreach($lastChat as $chat): ?>
	<li><a href='#'><?php if(isset($Users[$chat->getChatUserId()])): ?>
          <?= $UsersData[$chat->getChatUserId()]->getUserName(); ?>
    <?php else: ?>
          <?= $UsersData[-1]->getUserName(); ?>
    <?php endif; ?>
	: <?= $chat->getChatMessage() ?></a></li>
	<?php $i++; ?>
<?php endforeach; ?>
<?php if($i == 0): ?>
	<li><a href='#'><?= Yii::t('header', 'Text_No_Unread_Chat') ?></a></li>
<?php endif; ?>