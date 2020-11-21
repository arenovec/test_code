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

        public function actionLogout()
        {
            Yii::$app->session->regenerateID(true);

            if(!Yii::$app->user->isGuest) {
                Yii::$app->user->logout(true);
                return $this->redirect(['/site/index']);
            } else {
                return $this->redirect(['/site/index']);
            }
        }

        public function actionRemember()
        {
            
        }

        public function actionLogin()
        {

            $this->layout = 'clear';

            $login_model = new Login();

            $login_model->load(Yii::$app->request->post());

            if(\Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($login_model);
            }

            if(\Yii::$app->request->isPost) {
                if($login_model->validate()) {

                    if($login_model->getUser()->us_2_factor_auth != Users::AUTH_2FA_DISABLED) {
                        Yii::$app->session->set('user_id', $login_model->getUser()->us_id);
                        return $this->actionLogin2Fa();
                    }

                    Yii::$app->user->login($login_model->getUser(), 3600 * 24 * 7);
                    return $this->actionCabinet();
                }
            }
        }

        public function actionLogin2Fa()
        {
            $this->layout = 'clear';

            $user_id = Yii::$app->session->get('user_id', false);

            $user = Users::getByConditions([
                        'us_id' => $user_id
            ]);

            if(!$user)
                exit('error');

            if(Yii::$app->request->isPost) {

                $ga_code = Yii::$app->request->post("qa_verify_code", false);

                if($ga_code) {
                    $ga = new GoogleAuthenticator();
                    $checkResult = $ga->verifyCode($user->us_2_factor_auth_GA_secret, $ga_code, 2);

                    if($checkResult) {
                        $user_id = Yii::$app->session->remove('user_id');
                        Yii::$app->user->login($user, true);
                        return $this->actionCabinet();
                    } else {
                        $error = 'Код не верен';
                    }
                }

                $sms_code = Yii::$app->request->post("sms_code_verification", false);

                if($sms_code) {

                    $phoneCode = PhoneCodes::getByConditions([
                                'user_id' => $user->us_id,
                                'action' => PhoneCodes::ACTION_LOGIN,
                                ['>', 'attempts', 0],
                                ['>', 'expire', time()]
                    ]);

                    if(!$phoneCode)
                        return $this->redirect('logout');

                    if($phoneCode->code == $sms_code) {

                        PhoneCodes::deleteAll([
                            'user_id' => $user->us_id,
                            'action' => PhoneCodes::ACTION_LOGIN,
                        ]);

                        $user_id = Yii::$app->session->remove('user_id');
                        Yii::$app->user->login($user, true);
                        return $this->actionCabinet();
                    } else {
                        $phoneCode->attempts -= 1;

                        $phoneCode->save();

                        if($phoneCode->attempts < 1)
                            return $this->redirect('logout');

                        return $this->renderAjax('login-2-fa-sms', [
                                    'user' => $user,
                                    'error' => true,
                                    'attempts' => $phoneCode->attempts
                        ]);
                    }
                }
            }


            return $this->render('login-2-fa-ga', [
                        'error' => $error
            ]);
        }

        public function actionRegister()
        {
            $model = new Register;
            $model->load(Yii::$app->request->post());

            if(Yii::$app->request->isPjax) {
                if($model->validate()) {
                    $model->us_password = Yii::$app->security->generatePasswordHash($model->us_password);

                    if($model->save(false)) {

                        MailController::sendVerificationEmail(
                                $model->us_email, Yii::$app->security->encryptByPassword(
                                        $model->us_email, Yii::$app->request->cookieValidationKey
                                )
                        );
                    }
                    return $this->renderPartial('_verify-email');
                }
            }

            if(Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        public function actionVerifyEmail($code)
        {
            $email = \Yii::$app->security->decryptByPassword($code, Yii::$app->request->cookieValidationKey);

            if(!$email)
                exit('error!');

            $user = Users::getByConditions([
                        'us_email' => $email,
            ]);

            if($user->us_confirmed == Users::STATUS_CONFIRMED) {
                return $this->render('error', [
                            'message' => 'email_already_confirmed'
                ]);
            }

            if(!$user)
                exit('error!');

            $user->us_confirmed = Users::STATUS_CONFIRMED;
            $user->save();

            Yii::$app->user->login($user, true);

            $userRole = \Yii::$app->authManager->getRole('client');
            Yii::$app->authManager->assign($userRole, Yii::$app->user->getId());

            return $this->redirect('/site/index');
        }

        public function actionCabinet()
        {
            return $this->redirect(CController::profileUrl());
        }

    }
    