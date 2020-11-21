<?php

    /**
     * @link https://github.com/hrmohseni/yii2-morrisjs-charts
     * @copyright Copyright (c) 2015 Jura
     * @license http://opensource.org/licenses/BSD-3-Clause
     */

    namespace app\widgets\charts;

    use yii\base\InvalidConfigException;
    use yii\base\Widget;
    use yii\helpers\Html;
    use yii\helpers\Json;

    /**
     *
     * Chart renders a Morris.JS plugin widget.
     *
     */
    class MorrisCharts extends Widget
    {

        /**
         * @var array the options for Morris.JS charts.
         */
        public $clientOptions = [];

        /**
         *
         * @var array the HTML options for div element
         */
        public $elementOptions = [
            'style' => 'height: 250px;'
        ];

        /**
         * @var string the type of chart to display. The possible options are:
         * - "Line" 
         * - "Bar" 
         * - "Area"
         * - "Donut"
         */
        public $type;

        const TYPE_LINE = 'Line';
        const TYPE_AREA = 'Area';
        const TYPE_BAR = 'Bar';
        const TYPE_DONUT = 'Donut';

        /**
         * Initializes the widget.
         * This method will register the bootstrap asset bundle. If you override this method,
         * make sure you call the parent implementation first.
         */
        public function init()
        {
            parent::init();
            if($this->type === null || !$this->validateType($this->type)) {
                throw new InvalidConfigException("The 'type' option is required or not valid");
            }
            if(!isset($this->clientOptions['element'])) {
                $this->clientOptions['element'] = $this->getId();
            }
            $this->elementOptions['id'] = $this->clientOptions['element'];
            $this->validateRequiredOptions($this->type);
        }

        /**
         * Renders the widget.
         */
        public function run()
        {
            echo Html::tag('div', '', $this->elementOptions);
            $this->registerPlugin($this->type);
        }

        /**
         * 
         * @param type $name
         */
        protected function registerPlugin($name)
        {
            $view = $this->getView();
            MorrisChartsAssets::register($view);
            $options = Json::encode($this->clientOptions);
            $js = "new Morris.$name($options)";
            $view->registerJs($js);
        }

        /**
         * Validate type
         * 
         * @param string $type
         * @return boolean
         */
        protected function validateType($type)
        {
            return in_array($type, [self::TYPE_LINE, self::TYPE_AREA, self::TYPE_BAR, self::TYPE_DONUT]);
        }

        /**
         * Validate options
         * 
         * @param type $type
         * @return type
         */
        protected function validateRequiredOptions($type)
        {
            if(!isset($this->clientOptions['data'])) {
                throw new InvalidConfigException("The 'data' option is required");
            }
            if(!$type === self::TYPE_DONUT) {
                if(!isset($this->clientOptions['xkey'])) {
                    throw new InvalidConfigException("The 'xkey' option is required");
                }
                if(!isset($this->clientOptions['ykeys'])) {
                    throw new InvalidConfigException("The 'ykeys' option is required");
                }
                if(!isset($this->clientOptions['labels'])) {
                    throw new InvalidConfigException("The 'labels' option is required");
                }
            }
        }

    }
    