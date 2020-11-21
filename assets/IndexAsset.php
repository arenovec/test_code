<?php

    namespace app\assets;

    use yii\web\AssetBundle;

    class IndexAsset extends AssetBundle
    {

         public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'css/font-awesome.css',
            'css/ionicons.css',
            'css/admin/AdminLTE.css',
            'css/admin/_all-skins.css',
            'css/admin/skin-blue.css',
            'css/admin/admin_new.css'
        ];
        public $js = [
            
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\jui\JuiAsset',
            'yii\web\JqueryAsset',
            'yii\bootstrap\BootstrapPluginAsset',
        ];

    }
    