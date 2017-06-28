<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use app\models\Alert;
use app\classes\DateClass;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_News');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-news">
	<h1><?= Html::encode($this->title) ?></h1>
    
   <div class="row">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-warning"></i>

              <h3 class="box-title"><?= Yii::t('alert', 'Title_Alert') ?></h3>
            </div>
            <div class="box-body">
            <?php foreach($AlertData as $alert): ?>
            	<?php if($AlertType[$alert->getAlertTypeId()]->getAlertTypeColor() == "danger"): ?>
            	<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                	<h4><i class="icon fa fa-ban"></i><?= Yii::t('alert', 'Title_Danger') ?></h4>
                	<span class="alert-details"><?= $AlertType[$alert->getAlertTypeId()]->getAlertTypeMessage(Alert::getParameter($AlertType[$alert->getAlertTypeId()]->getAlertTypeParameter(), $alert->getAlertParameter(), $Land)) ?></span> 
                	<span class="time" style="float:right;"><i class="fa fa-clock-o"></i> <?= (new DateClass($alert->getAlertTime()))->showTimeElapsed(); ?></span>      
              	</div>
            	<?php elseif ($AlertType[$alert->getAlertTypeId()]->getAlertTypeColor() == "warning"): ?>
            	<div class="alert alert-warning alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                	<h4><i class="icon fa fa-warning"></i><?= Yii::t('alert', 'Title_Warning') ?></h4>
					<span class="alert-details"><?= $AlertType[$alert->getAlertTypeId()]->getAlertTypeMessage(Alert::getParameter($AlertType[$alert->getAlertTypeId()]->getAlertTypeParameter(), $alert->getAlertParameter(), $Land)) ?></span>
              		<span class="time" style="float:right;"><i class="fa fa-clock-o"></i> <?= (new DateClass($alert->getAlertTime()))->showTimeElapsed(); ?></span>
              	</div>
            	<?php endif; ?>
            <?php endforeach; ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-newspaper-o"></i>

              <h3 class="box-title"><?= Yii::t('alert', 'Title_Info') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php foreach($AlertData as $alert): ?>
            	<?php if($AlertType[$alert->getAlertTypeId()]->getAlertTypeColor() == "info"): ?>
            	<div class="alert alert-info alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                	<h4><i class="icon fa fa-info"></i><?= Yii::t('alert', 'Title_Info') ?></h4>
                	<span class="alert-details"><?= $AlertType[$alert->getAlertTypeId()]->getAlertTypeMessage(Alert::getParameter($AlertType[$alert->getAlertTypeId()]->getAlertTypeParameter(), $alert->getAlertParameter(), $Land)) ?></span>
              		<span class="time" style="float:right;"><i class="fa fa-clock-o"></i> <?= (new DateClass($alert->getAlertTime()))->showTimeElapsed(); ?></span>
              	</div>
            	<?php elseif ($AlertType[$alert->getAlertTypeId()]->getAlertTypeColor() == "success"): ?>
            	<div class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                	<h4><i class="icon fa fa-check"></i><?= Yii::t('alert', 'Title_Success') ?></h4>
                	<span class="alert-details"><?= $AlertType[$alert->getAlertTypeId()]->getAlertTypeMessage(Alert::getParameter($AlertType[$alert->getAlertTypeId()]->getAlertTypeParameter(), $alert->getAlertParameter(), $Land)) ?></span>
              		<span class="time" style="float:right;"><i class="fa fa-clock-o"></i> <?= (new DateClass($alert->getAlertTime()))->showTimeElapsed(); ?></span>
              	</div>
            	<?php endif; ?>
            <?php endforeach; ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>  
</div>
