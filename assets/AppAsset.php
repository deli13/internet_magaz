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
    public $css = [
        'css/site.css',
        '/vendor/bower/fancybox/dist/jquery.fancybox.css',
        '/vendor/bower/jquery-ui/themes/base/jquery-ui.min.css'
    ];
    public $js = [
        '/vendor/bower/jquery-ui/jquery-ui.min.js',
        '/vendor/bower/fancybox/dist/jquery.fancybox.js',
        '/js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
