<?php

    namespace app\widgets\sweetAlerts\assets;

    use yii\web\AssetBundle;

    /**
     * Class AnimateCssAsset
     * @package dominus77\sweetalert2\assets
     * @see https://github.com/daneden/animate.css
     */
    class AnimateCssAsset extends AssetBundle
    {

        /**
         * @var string
         */
        public $sourcePath = '@app/widgets/sweetAlerts/assets/dist/';

        /**
         * @var array
         */
        public $css = [];

        /**
         * @inheritdoc
         */
        public function init()
        {
            $min = YII_ENV_DEV ? '' : '.min';
            $this->css[] = 'animate' . $min . '.css';
        }

        /**
         * @var array
         */
        public $depends = [
            'yii\web\JqueryAsset',
        ];

    }
    