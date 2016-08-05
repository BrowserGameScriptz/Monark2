<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Chat');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-chat">
	<h1><?= Html::encode($this->title) ?></h1>
	
	<div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Direct Chat</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="3 New Messages" class="badge bg-green"><?= $UnReadUser ?></span>
                <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>-->
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                  <i class="fa fa-comments"></i></button>
                <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div id="scroll-msg" class="direct-chat-messages">
              <?php Pjax::begin(['id' => 'chat_content']); ?>
                <?php foreach($ChatData as $chat): ?>
	                <!-- Message. Default to the left -->
	                <div class="direct-chat-msg right">
	                  <div class="direct-chat-info clearfix">
	                    <span class="direct-chat-name pull-left">
	                    	<?php if(isset($Users[$chat->getChatUserId()])): ?>
	                    		<?= $Users[$chat->getChatUserId()]->getUserName(); ?>
	                    	<?php else: ?>
	                    		<?= $Users[-1]->getUserName(); ?>
	                    	<?php endif; ?>
	                    </span>
	                    <span class="direct-chat-timestamp pull-right"><?= date("d/m/Y, H:i:s", $chat->getChatTime()); ?></span>
	                  </div>
	                  <!-- /.direct-chat-info -->
	                  <!--<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
	                  <div class="direct-chat-text">
	                    <?= $chat->getChatMessage(); ?>
	                  </div>
	                  <!-- /.direct-chat-text -->
	                </div>
	                <!-- /.direct-chat-msg -->
             	<?php endforeach; ?>
             <?php Pjax::end(); ?>
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts">
                <ul class="contacts-list">
                  <li>
                    <a href="#">
                      <div class="contacts-list-info">
                            <table>
                            <?php foreach($GamePlayer as $player): ?>
								<?php if($player->getGamePlayerUserId() > 0 && $player->getGamePlayerBot() == 0): ?>
									<tr><td><font color="white"><?= $Users[$player->getGamePlayerUserId()]->getUserName(); ?></font></td></tr>
								<?php endif; ?>
							<?php endforeach; ?>
							</table>
                      </div>
                      <!-- /.contacts-list-info -->
                    </a>
                  </li>
                  <!-- End Contact Item -->
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <div class="input-group">
                  <input id='chat_msg_content' type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button id='button_send_chat' type="submit" class="btn btn-primary btn-flat">Send</button>
                      </span>
                </div>
            </div>
            <!-- /.box-footer-->
          </div>
          <div id="ajax-send-chat-return"></div>
</div>
