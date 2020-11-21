<?php
namespace app\widgets\MultiLang;

use app\models\Lang;
use yii\bootstrap\Widget;

class MultiLang extends Widget
{
    public function init(){}

    public function run() {
        return $this->render('view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}