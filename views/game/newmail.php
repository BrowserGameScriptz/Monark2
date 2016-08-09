<?php
use yii\web\View;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Mail');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-mail">
	<div class="box box-info">
		<div class="box-header ui-sortable-handle" style="cursor: move;">
			<i class="fa fa-envelope"></i>

			<h3 class="box-title">Game mail</h3>
		</div>
		<div class="box-body">
			<form action="#" method="post">
				<div class="form-group">
					<input type="email" class="form-control" name="emailto"
						placeholder="Email to:">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="subject"
						placeholder="Subject">
				</div>
				<div>
					<textarea class="textarea" style="width: 100%; height: 125px;"></textarea>
				</div>
			</form>
		</div>
		<div class="box-footer clearfix" style="text-align:center;">
			<button type="button" class="pull btn btn-success"
				id="sendEmail">
				Send <i class="fa fa-arrow-circle-right"></i>
			</button>
		</div>
	</div>
</div>
