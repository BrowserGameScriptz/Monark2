<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath = '@web';
    public $css = [
    		'css/AdminLTE.min.css',
    		'css/all-skins.min.css',
    		'css/site.css',
    		'css/ajax.css',
    		'css/context.css',
    		'css/jquery.contextMenu.css',
    ];
    public $js = [
    		'js/app.min.js',
    		'js/utils.js',
    		'js/jquery.contextMenu.js',
    		'js/jquery.ui.position.js',
    		'js/jquery.rightClick.js',
    		'js/json.min.js',
    		'js/chat.js',
    		'js/game/modals.js',
    		'js/game/anim.js',
    		'js/game/header.js',
    		'js/game/header_dropdown.js',
    ];
    public $depends = [
    		'rmrevin\yii\fontawesome\AssetBundle',
    		'yii\web\YiiAsset',
    		'yii\web\JqueryAsset',
    		'yii\bootstrap\BootstrapAsset',
    		'yii\bootstrap\BootstrapPluginAsset'
    ];
}
