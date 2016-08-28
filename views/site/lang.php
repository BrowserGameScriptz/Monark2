<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

/*
 	<!-- Session messages 
    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" style='text-align:center;'>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" style='text-align:center;'>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>-->
    <!-- End session messages -->
 */

$this->title = Yii::t('site', 'Title_Language');
?>
<div class="lang-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<br><br>
	<table  class="table table-striped table-bordered">
		<tr>
			<td><?= Html::a("<p class='flag flag-gb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".Yii::t('site', 'en')."</p>", ['/site/lang', 'lang' => 'en'], ['style' => "text-decoration: none;"]); ?></td>
		</tr>
		<tr>
			<td><?= Html::a("<p class='flag flag-fr'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".Yii::t('site', 'fr')."</p>", ['/site/lang', 'lang' => 'fr'], ['style' => "text-decoration: none;"]); ?></td>
		</tr>
	</table>
</div>