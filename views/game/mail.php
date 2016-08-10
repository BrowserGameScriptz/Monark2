<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use app\classes\DateClass;
use app\classes\StringClass;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Mail');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [ 
				AppAsset::className () 
		] 
] );

$this->registerJs('
$("document").ready(
	function(){
		$(".mailbox-content").on("click", function (){
			if($(this).next("tr").is(":visible"))	
				$(this).next("tr").hide();
			else
				$(this).next("tr").show();
		});			
	});
'); ?>
<div class="game-mail">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Inbox</h3>

			<div class="box-tools pull-right">
                <?= Html::a("<i class='fa fa-plus'></i> ".Yii::t('game', 'Button_New_Mail'), ['game/newmail'], ['class'=>'btn btn-success']); ?>
              </div>
			<!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body no-padding">
			<div class="table-responsive mailbox-messages">
				<table class="table table-hover table-striped">
					<tbody>
						<?php foreach($MailData as $mail): ?>
							<tr class="mailbox-content">
								<td class="mailbox-star"><?= Html::a("<i class='fa fa-reply'></i>", ['game/newmail', 'mi' => $mail->getMailId()]); ?></td>
								<td class="mailbox-name"><a href="#"><?= $this->context->getGamePlayerName($mail->getMailUserSendId(), $Users, $Bots) ?></a></td>
								<td class="mailbox-subject"><b><?= $mail->getMailSubject() ?></b> - <?= (new StringClass($mail->getMailMessage()))->getStringAbstract(50)  ?></td>
								<td class="mailbox-trash"><a href="#"><i class="fa fa-trash"></i></a></td>
								<td class="mailbox-date"><?= (new DateClass($mail->getMailTime()))->showTimeElapsed(); ?></td>
							</tr>
							<tr style="display:none;"><td></td><td></td><td>
								<div class="box box-primary">
						            <div class="box-body no-padding">
						              <div class="mailbox-read-info">
						                <h3><span id='subject'><?= $mail->getMailSubject() ?></span>
						                <span class="mailbox-read-time pull-right">
						                	<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete"><i class="fa fa-trash-o"></i></button>
							            	<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply"><i class="fa fa-reply"></i></button>
							            </span></h3>
							            <h4><span class="mailbox-read-time pull-left">From: <span id='from'><?= $this->context->getGamePlayerName($mail->getMailUserSendId(), $Users, $Bots) ?></span></span>
						                <span class="mailbox-read-time pull-right"><span id='date'><?= date("H:i:s d/m/Y", $mail->getMailTime()) ?></span></span></h4><br>
						             </div>
						              <div class="mailbox-read-message" style="white-space: pre-wrap;">
						                <span class="pull-left"><span id='mail'><?= $mail->getMailMessage() ?></span></span>
						              </div>
						            </div>
					     		</div>
					     	</td><td></td><td></td></tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<!-- /.table -->
			</div>
			<!-- /.mail-box-messages -->
		</div>
	</div>
</div>
