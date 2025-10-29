<?php

namespace app\controllers;

use Yii;
    use app\models\{LoginForm, User, Change_password};
    use yii\helpers\Url;
    use yii\base\DynamicModel;

class SiteController extends AppController
{

    public function init()
    {
    
        parent::init();

        Url::remember();
        
        $this->layout = 'main';

        // END public function init();
    }
    
    public function actionAtlassianDomainVerification() {
    	$string = file_get_contents(__DIR__ . '/../atlassian-domain-verification.html');
    	echo $string;
    	die;
    }

    public function beforeAction($action) 
    {
	    if (parent::beforeAction($action)) {

	        // change layout for error action
	        ($action->id == 'error' && !Yii::$app->user->isGuest) ? $this->layout = $this->controller : $this->layout = 'main';
	        return true;
	    } else {
	    	return false;
	    }


	    // END public function beforeAction($action);
	}

    public function actionLogin()
    {
        $this->setMeta('Сторінка входу');

        if (!Yii::$app->user->isGuest) {

            return $this->redirect(['/' . $this->controller . '']);
            
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->redirect(['/' . $this->controller . '']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);

        // END public function actionLogin();
    }

    public function actionNewPassword($username, $id, $hash)
    {
        if (Yii::$app->user->isGuest) {

            if (!empty($username) && !empty($id) && !empty($hash)) :

                $this->setMeta('Введіть новий пароль');
                $model_user = User::findOne($id);

                $model = new DynamicModel(['new_password', 're_password']);
                $model->addRule(['new_password', 're_password'], 'string', ['max' => 128])
                ->addRule(['new_password'], 'required', ['message' => 'Необхідно заповнити поле "Новий пароль".'])
                ->addRule(['re_password'], 'required', ['message' => 'Необхідно заповнити поле "Повторіть новий пароль".'])
                ->addRule(['re_password'], 'compare', ['compareAttribute' => 'new_password', 'message' => 'Значення "Повторіть новий пароль" повинно бути рівним "Новий пароль".']);

                $new_request = Change_password::findOne(['email' => $model_user->email, 'status' => 'pending']);

                if ($new_request->hash == $hash && $new_request->status == 'pending' && $new_request->user->id == $id && $new_request->user->username == $username) {

                    if (Yii::$app->request->post()) :

                        $new_password = Yii::$app->request->post('DynamicModel')['new_password'];
                        $re_password = Yii::$app->request->post('DynamicModel')['re_password'];

                        if (!empty($new_password) && !empty($re_password)) {

                            if ($new_password == $re_password) {

                                $model_user->password = Yii::$app->security->generatePasswordHash($new_password);
                                $model_user->real_password = $new_password;

                                if ($model_user->save()) :

                                    $new_request->status = 'changed';
                                    $new_request->date_change = myDate() . ' | ' . myTime();
                                    $new_request->save();

                                    Yii::$app->session->setFlash('success', 'Ваш пароль успішно змінено!');

                                    return $this->redirect(['site/login']);

                                endif;

                            } else {
                                Yii::$app->session->setFlash('error', 'Паролі не співпадають!');
                            }

                        } else {
                            Yii::$app->session->setFlash('error', 'Пароль не може бути пустим!');
                        }

                    endif;

                    return $this->render('new-password', [
                        'model' => $model
                    ]);

                } else {
                    throw new \yii\web\NotFoundHttpException();
                }

            endif;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionNewPassword();
    }

    public function actionForgotPassword()
    {

        if (Yii::$app->user->isGuest) {

            $this->setMeta('Забули пароль?');
            $model = new Change_password();
            
            if (Yii::$app->request->post()) :

                $email = Yii::$app->request->post('Change_password')['email'];
                $check_email = User::findOne(['email' => $email]);

                if (empty($check_email)) {
                    Yii::$app->session->setFlash('error', '<strong>Помилка.</strong> Даний E-mail не зареєстрований у системі!');
                } else {

                    $hash = generateRandomString(50);

                    Yii::$app->db->createCommand()->update('change_password', ['status' => 'rejected'], [
                    	'email' => $email,
                    	'status' => 'pending'])->execute();

                    $model->email = $email;
                    $model->hash = $hash;
                    $model->status = 'pending';
                    $model->date_change = myDate() . ' | ' . myTime();

                    if ($model->save()) {

                        $new_request = Change_password::findOne(Yii::$app->db->getLastInsertID());
                        $user = $new_request->user;

                        $to   = Yii::$app->request->post('Change_password')['email'];
                        $from = Yii::$app->params['supportEmail'];

                        Yii::$app->mailer->compose('forgot_password', compact('user', 'hash'))
                        ->setFrom([$from => 'Відновлення паролю'])
                        ->setTo($to)
                        ->setSubject('Відновлення паролю - School Diary')
                        ->send();
                    }

                    Yii::$app->session->setFlash('success', 'Інструкцію по відновленню паролю було надіслано на Ваш E-mail!');

                    return $this->refresh();
                }

            endif;

        	return $this->render('forgot-password', [
                'model' => $model,
                'request' => Yii::$app->request->post('Change_password')
            ]);
    	} else {
    		throw new \yii\web\NotFoundHttpException();
    	}

    	// END public function actionForgotPassword();
    }

    // END class SiteController;
}
