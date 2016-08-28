<?php
use yii\web\View;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Mail');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<?php 
	$subject = "";
	$to = "";
	$mail = "";
	if(isset($MailData)){
		$subject = Yii::t('game', 'Txt_Mail_Re').":".$MailData->getMailSubject();
		$to = $this->context->getGamePlayerName($MailData->getMailUserSendId(), $Users, $Bots);
		$mail = Yii::t('game', 'Txt_Mail_By_To_{user}_{time}_{date}', ['user' => $to, 'time' => date("H:i:s", $MailData->getMailTime()), 'date' => date("d/m/Y", $MailData->getMailTime())])." : 
		".$MailData->getMailMessage();
	}
?>
<?php $form = ActiveForm::begin([
        'id' => 'send-mail-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    	]); ?>
<div class="game-mail">
	<div class="box box-info">
		<h3 class="box-titles"> <i class="fa fa-envelope"></i> <?= Yii::t('game', 'Title_Game_New_Mail') ?></h3>
		<?= $form->field($model, 'mail_to')->textInput(['style'=>'width:500px', 'value' => $to]) ?>
		<?= $form->field($model, 'mail_subject')->textInput(['style'=>'width:500px', 'value' => $subject]) ?>
		<?= $form->field($model, 'mail_message')->textArea(['rows' => '8', 'style'=>'width:500px', 'value' => $mail]) ?>
		
		<div style='text-align:center;'>
        	 <?= Html::submitButton(Yii::t('game', 'Button_Mail_Send'), ['class' => 'btn btn-success', 'name' => 'send-button']) ?>
    	</div>
    	<br>
    </div>
</div>
 <?php ActiveForm::end(); ?>
