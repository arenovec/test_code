<?php

/*

 *     Author:  Hishnik  
 *     E-mail:  arenovec@gmail.com    
 *     skype:   kidw810i 
 * 
 *     Copyright (C) 2017 Hishnik
 */

namespace app\widgets\timepicker;

use yii\web\AssetBundle;

class TimePickerAsset extends AssetBundle{
	
        public $sourcePath = '@app/widgets/datetimepicker/assets';
	public $css = [
            'css/datetimepicker.css'
	];
	
	public $js = [
            'js/datepickerAddon.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
                'yii\jui\JuiAsset',
	];
        
       
               
        
}
