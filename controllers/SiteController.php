<?php

    namespace app\controllers;

    use app\components\GoogleAuthenticator;
    use app\models\Categorys;
    use app\models\Login;
    use app\models\PharmacyBlockedGoods;
    use app\models\PharmacyGoods;
    use app\models\PharmacyOrders;
    use app\models\Register;
    use app\models\Users;
    use Yii;
    use yii\helpers\Url;
    use yii\web\Cookie;
    use yii\web\Response;
    use yii\widgets\ActiveForm;

    class SiteController extends CController
    {

        public function actionIndex()
        {
           
            return $this->render(\Yii::$app->controller->action->id, []);
        }

    }
    