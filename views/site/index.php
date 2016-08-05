<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = Yii::$app->name['name'];
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?php echo Yii::t('site', 'Home_Monark_Welcome') ?></h1>

        <p class="lead"><?php echo Yii::t('site', 'Home_Monark_Description') ?></p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4" style="text-align:center;">
                <!--<h2><?php echo Yii::t('site', 'Button_Registration') ?></h2>-->

                <p><?= Html::a("<img src='img/site/registration.png' width='200px' height='200px'>", ['/user/sign']); echo "<br><i>".Yii::t('site', 'Home_Registration_Description') ?></i></p>

				 <p><?= Html::a(Yii::t('site', 'Button_Registration'), ['/user/sign'], ['class'=>'btn btn-primary', 'style'=>'width:50%;']); ?></p>
            </div>
            <div class="col-lg-4" style="text-align:center;">
                <!--<h2><?php echo Yii::t('site', 'Button_Login') ?></h2>-->

                <p><?= Html::a("<img src='img/site/login.png' width='200px' height='200px'>", ['/user/login']); echo "<br><i>".Yii::t('site', 'Home_Login_Description') ?></i></p>

                <p><?= Html::a(Yii::t('site', 'Button_Login'), ['/user/login'], ['class'=>'btn btn-primary', 'style'=>'width:50%;']); ?></p>
            </div>
            <div class="col-lg-4" style="text-align:center;">
                <!--<h2><?php echo Yii::t('site', 'Button_Tutorial') ?></h2>-->

                <p><?= Html::a("<img src='img/site/tutorial.png' width='200px' height='200px'>", ['/site/tutorial']); echo "<br><i>".Yii::t('site', 'Home_Tutorial_Description') ?></i></p>
                
				 <p><?= Html::a(Yii::t('site', 'Button_Tutorial'), ['/site/tutorial'], ['class'=>'btn btn-primary', 'name'=> 'tutorial_button', 'style'=>'width:50%;']); ?></p>
            </div>
        </div>

    </div>
</div>
