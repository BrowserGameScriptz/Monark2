<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\controllers\GameController;
use yii\web\View;
use app\models\GameData;
/* @var $this \yii\web\View */

/* @var $content string */
$refresh_time = Yii::$app->session['MapData']['RefreshTime'];
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Yii::$app->name['short'] . '</span><span class="logo-lg">' . Yii::$app->name['name'] . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
	
	<nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <?php if(!Yii::$app->user->isGuest): ?>
        <div id='navbar-menu-global' class="navbar-custom-menu">
           		<ul class="nav navbar-nav">
           			<li class="dropdown user user-menu">
           			<?php if(isset(Yii::$app->session['Game']) && Yii::$app->session['MapData'] != null): ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="background: #<?= Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorCss()?>">
                        	<span class="hidden-xs"><font size='4' color='<?= Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorFontChat()?>'>
            					<?= Yii::$app->session['MapData']['UserData'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerUserId()]->getUserName()?>
            				</font></span>
            			</a>
                    <?php else: ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	<span class="hidden-xs"><font size='3' color="black"><?= Yii::$app->session['User']->getUsername() ?></font></span>
                    </a>
                    <?php endif; ?>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?php print(Yii::$app->session['User']->getUsername()); ?>
                                <!--<small><?php print(Yii::$app->session['User']->getUsername()); ?></small>-->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#"><?php print(Yii::t('header', 'Profile')); ?></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"><?php print(Yii::t('header', 'Settings')); ?></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"><?php print(Yii::t('header', 'Friends')); ?></a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    Yii::t('header', 'Language'),
                                    ['/site/lang'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <!--<div class="pull-center">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>-->
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('header', 'Logout'),
                                    ['/user/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                
                <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-plus"></i></a>
                </li>-->
           	</ul>
        </div>
        	<?php if(isset(Yii::$app->session['Game']) && Yii::$app->session['MapData'] != null): ?>
        	<?php 
				// Time gestion
				$diff = time() - Yii::$app->session['MapData']['CurrentTurnData']->getTurnTime();
				gmdate("H:i:s", (time() - Yii::$app->session['MapData']['CurrentTurnData']->getTurnTime()));
				if($diff < 60){				$turn_length = gmdate("s", $diff);
				}elseif($diff < 60 * 60){ 	$turn_length = gmdate("i:s", $diff);	
				}else{ 						$turn_length = gmdate("H:i:s", $diff);}
			?>       	        
        		<div id='navbar-menu-game' class="navbar-custom-menu">
            		<?php Pjax::begin(['id' => 'navbar-menu-game-data']); ?>
            		<?php
            			$count_lands = 0;
				    	$count_units = 0;
				    	foreach (Yii::$app->session['MapData']['GameData'] as $data){
				    		if($data->getGameDataUserId() == Yii::$app->session['User']->getUserID()){
				    			$count_units +=	$data->getGameDataUnits();
				    			$count_lands++;
				    		}
				    	}
				    ?>
            		<ul class="nav navbar-nav">
	                	<!-- User Account: style can be found in dropdown.less -->
					 		<li id='turn' class="header_game_content">
		                		<?php if(Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId() == Yii::$app->session['User']->getUserID()): ?>
						        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration:none;top:6px;padding:0px;">	
					          		<span class="btn btn-info">	
					          			<?= Yii::t('header', 'Text_Turn_Lenght') ?> : <span id="turn_length"><?= $turn_length ?></span> 
					          		</span>&nbsp;&nbsp;
					          		<span class="btn btn-success">
					          			<font size="4"><?= Yii::t('header', 'Text_Your_turn') ?></font>
					          		</span>&nbsp;&nbsp;
					          		<span id='end_of_turn_link' class="btn btn-success">	
					          			<?= Yii::t('header', 'Button_Turn_Own') ?> 
					          		</span>
						        <?php else: ?>
						        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration:none;top:6px;padding:0px;">
						        	<span class="btn btn-info">	
					          			<?= Yii::t('header', 'Text_Turn_Lenght') ?> : <span id="turn_length"><?= $turn_length ?></span> 
					          		</span>&nbsp;&nbsp;
						        	<span class="btn btn-info">
						        		<font size="4">&nbsp;&nbsp;<?= Yii::t('header', 'Text_Turn_Other') ?></font>
	    								<font size='4' color='#<?=Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId()]->getGamePlayerColorId()]->getColorCss()?>'>
	            							<?=Yii::$app->session['MapData']['UserData'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId()]->getGamePlayerUserId()]->getUserName()?>
	            						</font>
	            					</span>
						        <?php endif; ?>
						        </a>
		                	</li>
		                	<li id='current_gold_content' class="dropdown tasks-menu">
		                		<a href="#" id='current_gold_link' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					          		<font size='3'><?= Yii::t('header', 'Text_Gold') ?>  : <i class="fa fa-usd"> <?= Yii::$app->session['MapData']['LastTurnData']->getTurnGold() ?> </i></font>
					          	</a>
					          	<ul class="dropdown-menu" style="width:100%">
					              <li class="header"><?= Yii::t('header', 'Title_Last_Buy') ?> </li>
					              <li><ul class="menu"></ul></li>
					              <!--<li class="footer"><a href="<?= Yii::$app->urlManager->createUrl(['game/gold']) ?>">View all</a></li>-->
					            </ul>
		                	</li>
		                	<li id="gold_per_turn_content" class="dropdown tasks-menu">
		                		<a href="#" id='gold_per_turn_link' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					           		<font size='3'><?= Yii::t('header', 'Text_Income') ?>  : <i class="fa fa-usd">
					           		<?= GameData::GoldGameDataUser(Yii::$app->session['MapData']['GameData'], Yii::$app->session['Game']->getGameId(), Yii::$app->session['User']->getUserID(), $count_lands) ?> / tr </i></font>
					           	</a>
					           	<ul class="dropdown-menu" style="width:100%">
					              <li class="header"><?= Yii::t('header', 'Text_Income') ?> </li>
					              <li><ul class="menu"></ul></li>
					              <!--<li class="footer"><a href="<?= Yii::$app->urlManager->createUrl(['game/income']) ?>">View all</a></li>-->
					            </ul>
		                	</li>
		                	<li class="dropdown tasks-menu">
		                		<a href="#" id='count_region' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					          		<font size='3'><?= Yii::t('header', 'Text_Country') ?> : <?= $count_lands ?> </font>
					          	</a>
		                	</li>
		                	<li class="dropdown tasks-menu">
		                		<a href="#" id='count_units' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					          		<font size='3'><?= Yii::t('header', 'Text_Units') ?>  : <?= $count_units ?> </font>
					          	</a>
		                	</li>
		                	<li class="dropdown tasks-menu">
					            <a href="#" id='header_messages' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">  
						            <i class="fa fa-envelope-o"></i>
						            <span class="label label-success">4</span>
					            </a>
					            <ul class="dropdown-menu" style="width:100%">
					              <!--<li class="header">You have 10 notifications</li>-->
					              <li>
					                <!-- inner menu: contains the actual data -->
					                <ul class="menu">
					                  
					                </ul>
					              </li>
					              <li class="footer"><a href="<?= Yii::$app->urlManager->createUrl(['game/mail']) ?>">View all</a></li>
					            </ul>
		                	</li>
		                	<li id='last_chat_content' class="dropdown tasks-menu">
					            <a href="#" id='last_chat_link' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
						            <i class="fa fa-weixin"></i>
						            <span class="label label-warning"><?=Yii::$app->session['MapData']['UserUnReadChat'] ?></span>
					            </a>
					            <ul class="dropdown-menu" style="width:100%">
					              <li class="header"><?= Yii::t('header', 'Title_Last_Chat') ?> </li>
					              <li><ul class="menu"></ul></li>
					              <li class="footer"><a href="<?= Yii::$app->urlManager->createUrl(['game/chat']) ?>"><?= Yii::t('header', 'Text_View_All') ?></a></li>
					            </ul>
		                	</li>
		                	<li class="dropdown tasks-menu">
					            <a href="#" id='header_alert' class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					              	<i class="fa fa fa-flag-o"></i>
					              	<span class="label label-danger">4</span>
					            </a>
					            <ul class="dropdown-menu" style="width:100%">
					              <!--<li class="header">You have 10 notifications</li>-->
					              <li>
					                <!-- inner menu: contains the actual data -->
					                <ul class="menu">
					                  
					                </ul>
					              </li>
					              <li class="footer"><a href="<?= Yii::$app->urlManager->createUrl(['game']) ?>">View all</a></li>
					            </ul>
		                	</li>
	                	
	                		<li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                	</ul>
                	<?php Pjax::end(); ?>
                </div>
                <div id='navbar-menu-lost-connection' class="navbar-custom-menu">
	                <ul class="nav navbar-nav">	
	                	<li id='lost_connexion' class="header_game_content" style="top:10px;">
              				<span id='lost_connection_text' class="blink callout callout-danger" style="display:none;padding:7px;">
              					<font color="yellow" size="4"><i class="fa fa-warning"></i> <?= Yii::t('header', 'Text_Lost_Connection') ?> <i class="fa fa-warning"></i></font>
              				</span>
		                </li>
		                <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
	                </ul>
                </div>
        <?php endif; ?>
      <?php endif; ?>
        <?php //<ul class="nav navbar-nav"><li class="dropdown user user-menu" style="background: #<?= Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorCSS() ;">?>       
    </nav>
</header>
