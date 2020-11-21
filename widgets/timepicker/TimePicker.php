<?php

    /*

     *     Author:  Hishnik  
     *     E-mail:  arenovec@gmail.com    
     *     skype:   kidw810i 
     * 
     *     Copyright (C) 2017 Hishnik
     */

    namespace app\widgets\timepicker;

    class TimePicker extends \yii\jui\DatePicker
    {

        public function run()
        {
            echo $this->renderWidget() . "\n";

            $containerID = $this->inline ? $this->containerOptions['id'] : $this->options['id'];
            $language = $this->language ? $this->language : \Yii::$app->language;

            if(strncmp($this->dateFormat, 'php:', 4) === 0) {
                $this->clientOptions['dateFormat'] = \yii\helpers\FormatConverter::convertDatePhpToJui(substr($this->dateFormat, 4));
            } else {
                $this->clientOptions['dateFormat'] = \yii\helpers\FormatConverter::convertDateIcuToJui($this->dateFormat, 'date', $language);
            }

            $view = $this->getView();
            TimePickerAsset::register($view);

            if($language !== 'en-US') {
                $assetBundle = \yii\jui\DatePickerLanguageAsset::register($view);
                $assetBundle->language = $language;
                $options = \yii\helpers\Json::htmlEncode($this->clientOptions);
                $language = \yii\helpers\Html::encode($language);
                $view->registerJs("$('#{$containerID}').timepicker($.extend({$options}));");
            } else {
                $this->registerClientOptions('timepicker', $containerID);
            }

            $this->registerClientEvents('timepicker', $containerID);
            \yii\jui\JuiAsset::register($this->getView());
        }

    }
    