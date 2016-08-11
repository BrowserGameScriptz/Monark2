<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <!--<section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>-->

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="hidden-xs" style="text-align: center;">
<font color="white">Copyright &copy; <?= Yii::$app->name['name'] ?> 2016 - Version 2.0.5.0 - Theme by <a href="http://almsaeedstudio.com" target="_blank">Almsaeed Studio</a></font>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-flag"></i></a></li>
        <li><a href="#control-sidebar-chat-tab" data-toggle="tab"><i class="fa fa-weixin"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
                <li>
                   
                </li>
            </ul>
            <h3 class="control-sidebar-heading">Ranking</h3>
            <ul class='control-sidebar-menu'>
                <li>
                   
                </li>
            </ul>
        </div>
        <!-- /.tab-pane -->

        <!-- Chat content -->
        <div class="tab-pane" id="control-sidebar-chat-tab">
            <h3 class="control-sidebar-heading">Chat of the game</h3>
            <ul class='control-sidebar-menu'>
                <li>
                   
                </li>
            </ul>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>