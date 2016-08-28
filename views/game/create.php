<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form ActiveForm */
$this->title = Yii::t ( 'game', 'Title_Create' );
?>

<div class="game-create">

	<h1><?= Html::encode($this->title) ?></h1>
	<br>
    <?php
				
	$form = ActiveForm::begin ( [ 
						'id' => 'login-form',
						'options' => [ 
								'class' => 'form-horizontal' 
						],
						'fieldConfig' => [ 
								'template' => "{label}\n<div class=\"col-lg-2\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
								'labelOptions' => [ 
										'class' => 'col-lg-3 control-label' 
								] 
						] 
				] );
				?>

        <?= $form->field($model, 'game_name')->textInput()->label(Yii::t('game', 'Tab_Game_Name'))?>
        <?= $form->field($model, 'game_max_player')->textInput(['type' => 'number'])->label(Yii::t('game', 'Txt_Game_Max_Player'))?>
        <?=$form->field ($model, 'game_map_id')->dropDownList ( 
        		ArrayHelper::map($MapData,
                function($model, $defaultValue) {
                	return $model->getMapId();
                },
                function($model, $defaultValue) {
                	return $model->getMapName();
                }
                ),
                [
                	'class'		=> 'selectpicker',
               ])->label(Yii::t('game', 'Tab_Map'));?>
        <!--<? //$form->field($model, 'game_mod_id') ?>-->
        <?=$form->field ($model, 'game_difficulty_id')->dropDownList ( 
        		ArrayHelper::map($DifficultyData,
                function($model, $defaultValue) {
                	return $model->getDifficultyId();
                },
                function($model, $defaultValue) {
                	return $model->getDifficultyName();
                }
                ),
                [
                	'class'		=> 'selectpicker',
               ])->label(Yii::t('game', 'Tab_Difficulty'));?>
        <?= $form->field($model, 'game_pwd')->passwordInput()->label(Yii::t('game', 'Txt_Game_Pwd'))?>
		<?= Html::checkbox('agree', true, ['label' => Yii::t('game', 'Spectator mod allowed')]); ?>
    <div class="form-group">
		<div class="col-lg-offset-3 col-lg-2">
                <?= Html::submitButton(Yii::t('game', 'Title_Create'), ['class' => 'btn btn-primary', 'name' => 'create-button'])?>
            </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
<!-- create -->
