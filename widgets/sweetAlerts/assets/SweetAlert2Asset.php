<?php

    namespace app\widgets\sweetAlerts\assets;

    use yii\web\AssetBundle;

    /**
     * Class SweetAlert2Asset
     * @package dominus77\sweetalert2\assets
     */
    class SweetAlert2Asset extends AssetBundle
    {

        /**
         * @var string
         */
        public $sourcePath = '@app/widgets/sweetAlerts/assets/dist/';

        /**
         * @var array
         */
        public $js = [];

        /**
         * @inheritdoc
         */
        public function init()
        {
            $min = YII_ENV_DEV ? '' : '.min';
            $this->js[] = 'sweetalert2.all' . $min . '.js';
        }

    }
    