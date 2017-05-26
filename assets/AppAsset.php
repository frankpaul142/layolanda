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
        'css/bootstrap-select.min.css',
        'https://fonts.googleapis.com/css?family=Yantramanav',
        'css/ekko-lightbox.css'
    ];
    public $js = [
        'js/masonry.pkgd.min.js',
        'js/imagesloaded.pkgd.js',
        'js/bootstrap-select.min.js',
        'js/bootstrap.min.js',
        'js/jquery.sticky.js',
        'js/ekko-lightbox.js',
        'js/backgroundVideo.js',
        '//assets.pinterest.com/js/pinit.js'
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
