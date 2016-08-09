<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use app\classes\DateClass;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Mail');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [ 
				AppAsset::className () 
		] 
] );
?>

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
							<tr>
								<td class="mailbox-star"><a href="#"><i class="fa fa fa-share"></i></a></td>
								<td class="mailbox-name"><a href="#"><?= $this->context->getGamePlayerName($mail->getMailUserSendId(), $Users, $Bots) ?></a></td>
								<td class="mailbox-subject"><b><?= $mail->getMailSubject() ?></b> - <?= $mail->getMailMessage() ?>...</td>
								<td class="mailbox-trash"><a href="#"><i class="fa fa-trash"></i></a></td>
								<td class="mailbox-date"><?= (new DateClass($mail->getMailTime()))->showTimeElapsed(); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<!-- /.table -->
			</div>
			<!-- /.mail-box-messages -->
		</div>
	</div>
</div>
