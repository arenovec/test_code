<?php

    namespace app\controllers;

    use app\modules\client\controllers\WalletsController;
    use Da\QrCode\Action\QrCodeAction;
    use Yii;
    use yii\helpers\Url;
    use yii\web\Controller;

    class CController extends Controller
    {

        public function beforeAction($action)
        {
            return parent::beforeAction($action);
        }

        public static function translit($str)
        {
            return strtr($str, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'E', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', ' ' => '_'));
        }

        /**
         * Возвращает ссылку на профиль на основе роли
         * 
         * @return string
         */
        public static function profileUrl()
        {
            if(Yii::$app->user->isGuest)
                return Url::toRoute(['/site/']);

            $usr_roles = Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
            $role = array_shift($usr_roles)->name;

            switch ($role)
            {
                case "admin":
                    return Url::toRoute('/admin/main/logout');
                    break;

                default:
                    return false;
            }
        }

        public static function getRoundedValue($value)
        {
            return number_format(round($value, 2, PHP_ROUND_HALF_DOWN), 2, '.', '');
        }

        public function actionFormValidation($name)
        {
            $model = new $name();

            $model->load(\Yii::$app->request->get());
            $model->load(\Yii::$app->request->post());

            if(Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

    }
    