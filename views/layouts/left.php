<?php
use app\classes\Access;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?php if(!Yii::$app->user->isGuest && 1 == 2): ?>
        <div class="user-panel">
            <div class="pull-left image">
                <!--<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
                <br><br>
            </div>
            <div class="pull-left info">
                <p><?php print(Yii::$app->session['User']->getUsername()); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- search form --><!--
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => Yii::t('menu', 'Title_Menu'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('menu', 'Title_Home'), 'icon' => 'fa fa-home', 'url' => ['/'], 'visible' => !Access::UserIsConnected() && !Access::UserIsInGame()],                    
                		
                    /* Guest */
                    ['label' => Yii::t('menu', 'Title_Game'), 'icon' => 'fa fa-gamepad', 'url' => ['site/game'], 'visible' => !Access::UserIsConnected()],
                    ['label' => Yii::t('menu', 'Title_Sign'), 'icon' => 'fa fa-sign-in', 'url' => ['user/sign'], 'visible' => !Access::UserIsConnected()],
                    ['label' => Yii::t('menu', 'Title_Login'), 'icon' => 'fa fa-unlock', 'url' => ['user/login'], 'visible' => !Access::UserIsConnected()],
                    
                    /* Connected */
                	['label' => Yii::t('menu', 'Title_Game_List'), 'icon' => 'fa fa-gamepad', 'url' => ['game/index'], 'visible' => Access::UserIsConnected() && !Access::UserIsInGame()],
                	['label' => Yii::t('menu', 'Title_Game_Create'), 'icon' => 'fa fa-plus', 'url' => ['game/create'], 'visible' => Access::UserIsConnected() && !Access::UserIsInGame()],
                    
                	/* Game */	
                	// Statut ==> before game
                	['label' => Yii::t('menu', 'Title_Game_Lobby'), 'icon' => 'fa fa-users', 'url' => ['game/lobby'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInNotStartedGame()], 
                		
                	// Statut ==> in game
                	['label' => Yii::t('menu', 'Title_Game_Map'), 'icon' => 'fa fa-globe', 'url' => ['game/map'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInStartedGame() || Access::UserIsInEndedGame()],
                	['label' => Yii::t('menu', 'Title_Game_News'), 'icon' => 'fa fa-newspaper-o', 'url' => ['game/news'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInStartedGame() || Access::UserIsInEndedGame()],
                	['label' => Yii::t('menu', 'Title_Game_Diplomacy'), 'icon' => 'glyphicon glyphicon-knight', 'url' => ['game/diplomacy'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInStartedGame() || Access::UserIsInEndedGame()],
                	['label' => Yii::t('menu', 'Title_Game_History'), 'icon' => 'fa fa-history', 'url' => ['game/history'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInStartedGame() || Access::UserIsInEndedGame()],
                	['label' => Yii::t('menu', 'Title_Game_Stats'), 'icon' => 'fa fa-pie-chart', 'url' => ['game/stats'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInStartedGame() || Access::UserIsInEndedGame()],
                	['label' => Yii::t('menu', 'Title_Game_Ranking'), 'icon' => 'fa fa-star', 'url' => ['game/rank'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInStartedGame() || Access::UserIsInEndedGame()],
                	
                	// Always in game
                	['label' => Yii::t('menu', 'Title_Game_Chat'), 'icon' => 'fa fa-weixin', 'url' => ['game/chat'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInGame()],
                	['label' => Yii::t('menu', 'Title_Game_Mail'), 'icon' => 'fa fa-envelope-o', 'url' => ['game/mail'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInGame()],	 
                		
                	// Tutorial
                	['label' => Yii::t('menu', 'Title_Tutorial'), 'icon' => 'fa fa-question', 'url' => ['site/tutorial']], 
                		
                	// Quit	
                	['label' => Yii::t('menu', 'Title_Game_Quit'), 'icon' => 'fa fa-sign-out', 'url' => ['game/quit'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsInGame()],
                		
                    // Logout
                    // temp solution WANTED TO POST 
                    ['label' => Yii::t('menu', 'Title_Logout'), 'icon' => 'fa fa-sign-out', 'url' => ['user/logout'], 'template' => '<a href="{url}" data-method="post">{icon}{label}</a>', 'visible' => Access::UserIsConnected() && !Access::UserIsInGame()],
                ],
            ]
        ) ?>

    </section>

</aside>
