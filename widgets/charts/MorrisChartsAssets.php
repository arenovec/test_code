<?php

    namespace app\widgets\charts;

    use yii\web\AssetBundle;

    class MorrisChartsAssets extends AssetBundle
    {

        public $sourcePath = '@app/widgets/charts/assets';
     
        public $css = [
            'css/morris.css'
        ];
        public $js = [
            'js/morris.js',
            'js/raphael.js'
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\jui\JuiAsset',
        ];

    }
    