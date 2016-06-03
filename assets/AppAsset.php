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
        'css/w3.css',
        'css/page.css',
        'css/font-awesome/css/font-awesome.min.css',
        'js/arcticmodal/jquery.arcticmodal-0.3.css',
        'js/arcticmodal/themes/simple.css',
    ];
    public $js = [
//        'js/jquery.min.js',
        'js/arcticmodal/jquery.arcticmodal-0.3.min.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_BEGIN
    ];
}
