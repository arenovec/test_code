<?php

    namespace app\controllers;

    use app\models\SiteSettings;
    use Yii;
    use yii\helpers\Html;
    use yii\helpers\Url;

    class MailController
    {

        /**
         * Отправляет письмо с подтверждением почты
         * 
         * @param string $mail  - E-Mail получателя
         * @param string $code  - код подтверждения
         */
        public static function sendVerificationEmail($mail, $code)
        {
            Yii::$app->mailer->compose([
                        'html' => 'views/verificationEmail',
                            ], [
                        'verificationLink' => Html::a('Confirm', Url::toRoute(['site/verify-email', 'code' => $code], true))
                    ])
                    ->setTo([$mail])
                    ->setSubject("Подтверждение E-Mail")
                    ->send();
        }

        /**
         * Отправляет письмо с подтверждением почты
         * 
         * @param string $mail  - E-Mail получателя
         * @param string $code  - код подтверждения
         */
        public static function sendChangeEmailVerification($mail, $code)
        {
            Yii::$app->mailer->compose([
                        'html' => 'views/changeEmailVerification',
                            ], [
                        'code' => $code
                    ])
                    ->setTo([$mail])
                    ->setSubject("Change E-Mail Verification")
                    ->send();
        }

        /**
         * Отправляет письмо с восстановленим пароля
         * 
         * @param string $mail  - E-Mail получателя
         * @param string $code  - код подтверждения
         */
        public static function sendRememberEmail($mail, $code)
        {
            Yii::$app->mailer->compose([
                        'html' => 'views/rememberPassword',
                            ], [
                        'rememberLink' => Html::a(Yii::t('main', 'password_recovery'), Url::toRoute(['/site/remember-form', 'code' => $code], true))
                    ])
                    ->setTo([$mail])
                    ->setSubject(Yii::t('main', 'text19'))
                    ->send();
        }

    }
    