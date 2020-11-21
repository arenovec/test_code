<?php

    namespace app\controllers;

    use app\modules\owner\controllers\ProfileController;
    use Yii;
    use yii\web\Controller;

    class CallbackController extends Controller
    {

        public function beforeAction($action)
        {
            set_time_limit(15);
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
        }


    }
    