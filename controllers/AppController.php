<?php 
namespace app\controllers;

use Yii;
	use yii\web\{Controller, UploadedFile, Response};
    use yii\helpers\{Url, Html};
    use app\models\{User, Teachers, Telegram, BlockedIP, Questions, Support, Directors, ParamsTranslations, SystemSettings};
    use yii\filters\{VerbFilter, AccessControl};
    use yii\base\DynamicModel;
    use yii\widgets\ActiveForm;
    use linslin\yii2\curl\Curl;

class AppController extends Controller
{

    public $controller, $layout, $user_type, $telegram_id, $telegram_status, $director_teacher, $curl;
    
    public $school__payment_type, $school__price_for_all_school, $school__max_students, $_payment_for_all_school;

    protected $_ip_blocked, $_user_ip;
    protected $__token_security, $__token_notification, $__adminTelegramID, $__text;
    protected $__amount, $__currency;
    protected $___system_settings;

    protected $_LIQPAY_public_key = 'i38885926881';
    protected $_LIQPAY_private_key = '6dCsPY1MN7nYU6ufdWe7ZTzmuocSIjnh0PUOtrM3';
    protected $_LIQPAY_domain = 'https://www.liqpay.ua';
    protected $_LIQPAY_CHECKOUT = 'https://www.liqpay.ua/api/3/checkout';

    protected $_payment_user, $__payment_check;

    protected $title_for_marks_sheet = [
        '0' => 'Без теми',
        '1' => 'Контрольна робота',
        '2' => 'Самостійна робота',
        '3' => 'Тематична',
        '4' => 'I семестр',
        '5' => 'IІ семестр',
        '6' => 'Річна',
        '7' => 'Лабораторна',
        '8' => 'Семінар',
        '9' => 'Зошит',
        '10' => 'Усний переказ',
        '11' => 'Контрольний переказ',
        '12' => 'Контрольний диктант',
        '13' => 'Диктант',
        '14' => 'Читання вголос',
    ];
        
    protected $type_marks = [
        'Оцінка' => [
            '' => 'Без оцінки',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
            '11' => '11',
            '12' => '12',
        ],
        'Пропуск' => [
            'н' => 'н (Не було)',
            'хв' => 'хв (Хворий)',
        ],
    ];

    protected function setMeta($title = null, $keywords = null, $description = null)
    {

        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);

        // END protected function setMeta();
    }

    public function init()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        $this->___system_settings = SystemSettings::findOne(1);

        if ($this->___system_settings->stop === 1) {
            $html = '<title>Технічні роботи</title><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>';
            $html .= '<link rel="shortcut icon" href="' . Yii::$app->getHomeUrl() . 'images/project/favicon.ico" type="image/x-icon">';
            $html .= '<link rel="apple-touch-icon" href="' . Yii::$app->getHomeUrl() . 'images/project/apple-touch-iphone.png">';
            $html .= '<style>p{line-height:1.4;}p br{display:none;}@media(max-width:767px){p br{display:block;}h1{font-size: 21px;}}</style>';
            $html .= '<h1 style="text-align:center; font-family: sans-serif; margin-top:100px;">Вас вітає технічна підтримка School Diary.</h1>';
            $html .= '<p style="text-align:center; font-family: sans-serif;">На даний момент Адміністрація сайту проводить технічні роботи.</p>';
            $html .= '<p style="text-align:center; font-family: sans-serif;">Ми робимо все можливе, щоб користувачі якомога швидше продовжили користуватися сервісом.</p>';
            $html .= '<p style="text-align:center; font-family: sans-serif;">Вибачте за тимчасові незручності. Сайт незабаром запрацює.</p>';
            $html .= '<br><p style="text-align:center; font-family: sans-serif;">Якщо у Вас є якісь запитання, звертайтеся за електронною адресою: <strong>' . Yii::$app->params['supportEmail'] . '</strong></p>';
            
            echo $html;
            die;
        }

        $this->_user_ip = Yii::$app->getRequest()->getUserIP();

    	$this->_ip_blocked = BlockedIP::findOne(['ip' => $this->_user_ip]);

    	if ($this->_ip_blocked) {

    		if ($this->_ip_blocked->time < time()) {
    			
                $this->_ip_blocked->delete();
    			return $this->redirect('/');

    		} else {

    			$html = '<title>IP Заблоковано.</title><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>';
                $html .= '<link rel="shortcut icon" href="' . Yii::$app->getHomeUrl() . 'images/project/favicon.ico" type="image/x-icon">';
                $html .= '<link rel="apple-touch-icon" href="' . Yii::$app->getHomeUrl() . 'images/project/apple-touch-iphone.png">';
    			$html .= '<style>p{line-height:1.4;}p br{display:none;}@media(max-width:767px){p br{display:block;}}</style>';
	    		$html .= '<p style="text-align:center; font-family: sans-serif; margin-top:100px;">На жаль, Ваш IP заблоковано. <br>Блокування буде знято ' . myDate('ua', $this->_ip_blocked->time) . ' - ' . myTime('H', $this->_ip_blocked->time) . '</p>';
	    		
	    		echo $html;
	    		die;
    		}
    		
    	}

        $this->school__payment_type = Yii::$app->user->identity->school->payment_for_school;
        $this->school__price_for_all_school = Yii::$app->user->identity->school->price_for_all_school;
        $this->school__max_students = Yii::$app->user->identity->school->max_students;

        $this->__amount = Yii::$app->user->identity->school->price;
        $this->__currency = Yii::$app->user->identity->school->currency;
        $this->_payment_user = Yii::$app->user->identity->paymentOfUser;

        if ($this->school__payment_type)
        {
            $this->_payment_for_all_school = Yii::$app->user->identity->getPaymentForAllSchool(Yii::$app->user->identity->school->id);
            if ($this->school__payment_type == 'all')
            {
                if (Yii::$app->user->identity->school->is_test == 'yes' || ($this->_payment_for_all_school && $this->_payment_for_all_school['max_date'] > time())) {
                    $this->__payment_check = true;
                } else {
                    $this->__payment_check = false;
                }
            } elseif ($this->school__payment_type == 'single')
            {
                if (Yii::$app->user->identity->school->is_test == 'yes' || ($this->_payment_user && $this->_payment_user['max_date'] > time())) {
                    $this->__payment_check = true;
                } else {
                    $this->__payment_check = false;
                }
            }
        } else {
            $this->school__payment_type = 'single';
            if (Yii::$app->user->identity->school->is_test == 'yes' || ($this->_payment_user && $this->_payment_user['max_date'] > time())) {
                $this->__payment_check = true;
            } else {
                $this->__payment_check = false;
            }
        }
        
        $this->curl = new Curl();

        $this->__token_security = Yii::$app->params['securityTelegramBotToken'];
        $this->__token_notification = Yii::$app->params['notificationTelegramBotToken'];
        $this->__adminTelegramID = Yii::$app->params['adminTelegramID'];

        $this->director_teacher = Teachers::findOne(['user_id' => Yii::$app->user->identity->id]);
        $this->telegram_id = User::findOne(Yii::$app->user->identity->id)->telegram->telegram_chat_id;
        $this->telegram_status = User::findOne(Yii::$app->user->identity->id)->telegram->status;

        switch (Yii::$app->user->identity->type) :
            
            case 'admin'    : $this->controller = 'admins';    $this->user_type = 'Адміністратор'; break;
            case 'teacher'  : $this->controller = 'teachers';  $this->user_type = 'Учитель';       break;
            case 'student'  : $this->controller = 'students';  $this->user_type = 'Учень';         break;
            case 'parent'   : $this->controller = 'parents';   $this->user_type = 'Батьки';        break;
            case 'director' : $this->controller = 'directors'; $this->user_type = 'Директор';      break;

        endswitch;

        $this->layout = $this->controller;
    	
        // END public function init();
    }

    public function beforeAction($action)
    {
        if (YII_ENV == 'prod') {
            if (Yii::$app->user->identity->type == 'admin') {

                $this->__text = urlencode("Хтось зайшов у систему як <b>Адміністратор</b>: \n<b>Url</b>: <code>" . Url::to() . "</code> \n\n<b>IP</b>: <code>" . $this->_user_ip . "</code> \n\nЧас: <b>" . myTime() . "</b> \nДата: <b>" . myDate() . "</b>");

                $response = $this->curl->get('https://api.telegram.org/bot' . $this->__token_security . '/sendMessage?text=' . $this->__text . '&chat_id=' . $this->__adminTelegramID . '&parse_mode=HTML');

            }
        }

        return parent::beforeAction($action);

        // END public function beforeAction($action);
    }

    public function actionEmptyTelegramId()
    {

        if (!Yii::$app->user->isGuest) {

        	if ($this->school__payment_type == 'all') {
                if ((!$this->telegram_id || $this->telegram_status == 'pending') && $this->__payment_check) {
                    $this->setMeta('Інструкція щодо збереження Telegram ID');
                    return $this->render('empty-telegram-id');
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }
            } elseif ($this->school__payment_type == 'single') {
            	if ((Yii::$app->user->identity->type == 'student' || Yii::$app->user->identity->type == 'parent') && $this->__payment_check) {
	                if (!$this->telegram_id || $this->telegram_status == 'pending') {
	                    $this->setMeta('Інструкція щодо збереження Telegram ID');
	                    return $this->render('empty-telegram-id');
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            } elseif (Yii::$app->user->identity->type != 'student' && Yii::$app->user->identity->type != 'parent') {
	                if (!$this->telegram_id || $this->telegram_status == 'pending') {

	                    $this->setMeta('Інструкція щодо збереження Telegram ID');
	                    return $this->render('empty-telegram-id');
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            }
            }

        } else {
            
            throw new \yii\web\NotFoundHttpException();
        }

        throw new \yii\web\NotFoundHttpException();

        // END public function actionEmptyTelegramId();
    }

    public function actionPrivacyPolicy()
    {
        $this->setMeta('Політика конфіденційності');
        return $this->render('privacy-policy');
    }

    public function actionRefundPolicy()
    {
        $this->setMeta('Політика повернення коштів');
        return $this->render('refund-policy');
    }

    public function actionPublicOffer()
    {
        $this->setMeta('Публічна оферта');
        return $this->render('public-offer');
    }

    public function actionInfoAboutDirector()
    {

        if (!Yii::$app->user->isGuest) {

        	if ($this->school__payment_type == 'all') {
                if ($this->__payment_check) {
                    $model = Directors::findOne(['school_id' => Yii::$app->user->identity->school->id]);
	                if ($model) {
	                    $director = $model->director;
	                    return $this->render('info-about-director', compact('director'));
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }
            } elseif ($this->school__payment_type == 'single') {
            	if ((Yii::$app->user->identity->type == 'student' || Yii::$app->user->identity->type == 'parent') && $this->__payment_check) {
	                $model = Directors::findOne(['school_id' => Yii::$app->user->identity->school->id]);
	                if ($model) {
	                    $director = $model->director;
	                    return $this->render('info-about-director', compact('director'));
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            }
	            if (Yii::$app->user->identity->type != 'student' && Yii::$app->user->identity->type != 'parent') {
	                $model = Directors::findOne(['school_id' => Yii::$app->user->identity->school->id]);
	                if ($model) {
	                    $director = $model->director;
	                    return $this->render('info-about-director', compact('director'));
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            }
            }
        }
        
        throw new \yii\web\NotFoundHttpException();

        // END public function actionInfoAboutDirector();
    }

    public function actionChangeTelegramId()
    {

        if (!Yii::$app->user->isGuest) {

        	if ($this->school__payment_type == 'all') {
                if ($this->__payment_check) {
                    if ($this->telegram_id) {
	                    $user = Telegram::findOne(['user_id' => Yii::$app->user->identity->id, 'telegram_chat_id' => $this->telegram_id]);
	                    $user->status = 'pending';
	                    $user->save();
	                    return $this->redirect(['/empty-telegram-id']);
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }
            } elseif ($this->school__payment_type == 'single') {
            	if ((Yii::$app->user->identity->type == 'student' || Yii::$app->user->identity->type == 'parent') && $this->__payment_check) {
	                if ($this->telegram_id) {
	                    $user = Telegram::findOne(['user_id' => Yii::$app->user->identity->id, 'telegram_chat_id' => $this->telegram_id]);
	                    $user->status = 'pending';
	                    $user->save();
	                    return $this->redirect(['/empty-telegram-id']);
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            } elseif (Yii::$app->user->identity->type != 'student' && Yii::$app->user->identity->type != 'parent') {
	                if ($this->telegram_id) {
	                    $user = Telegram::findOne(['user_id' => Yii::$app->user->identity->id, 'telegram_chat_id' => $this->telegram_id]);
	                    $user->status = 'pending';
	                    $user->save();
	                    return $this->redirect(['/empty-telegram-id']);
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            }
            }
            
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
        
        throw new \yii\web\NotFoundHttpException();

        // END public function actionChangeTelegramId();
    }

    public function actionCloseChangeTelegramId()
    {

        if (!Yii::$app->user->isGuest) {

        	if ($this->school__payment_type == 'all') {
                if ($this->__payment_check) {
                    if ($this->telegram_id) {
	                    $user = Telegram::findOne(['user_id' => Yii::$app->user->identity->id, 'telegram_chat_id' => $this->telegram_id]);
	                    if ($user->status == 'pending') {
	                        $user->status = 'closed';
	                        $user->save();
	                        Yii::$app->session->setFlash('success', '<b>Telegram ID</b> успішно збережено у системі <b>School Diary</b>!');
	                        return $this->redirect(['/about-me']);
	                    } else {
	                        throw new \yii\web\NotFoundHttpException();
	                    }
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }
            } elseif ($this->school__payment_type == 'single') {
            	if ((Yii::$app->user->identity->type == 'student' || Yii::$app->user->identity->type == 'parent') && $this->__payment_check) {
	                if ($this->telegram_id) {
	                    $user = Telegram::findOne(['user_id' => Yii::$app->user->identity->id, 'telegram_chat_id' => $this->telegram_id]);
	                    if ($user->status == 'pending') {
	                        $user->status = 'closed';
	                        $user->save();
	                        Yii::$app->session->setFlash('success', '<b>Telegram ID</b> успішно збережено у системі <b>School Diary</b>!');
	                        return $this->redirect(['/about-me']);
	                    } else {
	                        throw new \yii\web\NotFoundHttpException();
	                    }
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            } elseif (Yii::$app->user->identity->type != 'student' && Yii::$app->user->identity->type != 'parent') {
	                if ($this->telegram_id) {
	                    $user = Telegram::findOne(['user_id' => Yii::$app->user->identity->id, 'telegram_chat_id' => $this->telegram_id]);
	                    if ($user->status == 'pending') {
	                        $user->status = 'closed';
	                        $user->save();
	                        Yii::$app->session->setFlash('success', '<b>Telegram ID</b> успішно збережено у системі <b>School Diary</b>!');
	                        return $this->redirect(['/about-me']);
	                    } else {
	                        throw new \yii\web\NotFoundHttpException();
	                    }
	                } else {
	                    throw new \yii\web\NotFoundHttpException();
	                }
	            }
            }
            
        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionCloseChangeTelegramId();
    }
    
    public function actionAboutMe()
    {

        if (!Yii::$app->user->isGuest) {

            $this->setMeta('Інформація про себе');

            $user = User::findOne(Yii::$app->user->identity->id);

            $payment_check = $this->__payment_check;

            return $this->render('about-me', compact('user', 'payment_check'));

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionAboutMe();
    }

    public function actionChangeInfoAboutMe()
    {

        if (!Yii::$app->user->isGuest) {

            $this->setMeta('Змінити інформацію про себе');

            $model = User::findOne(Yii::$app->user->identity->id);

            if (Yii::$app->request->isPost) :

                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                   
                   Yii::$app->response->format = Response::FORMAT_JSON;
                   return ActiveForm::validate($model);
                
                } elseif (Yii::$app->request->post('remove-image')) {

                    unlink(Yii::$app->basePath . '/web' . $model->image);

                    $model->image = '/images/_no_user.png';

                    $model->save();

                    Yii::$app->session->setFlash('success', 'Зображення успішно видалено!');

                } else {

                    $check = 1;
                    
                    $check_username = User::find()->select(['id', 'username'])->where(['username' => Yii::$app->request->post('User')['username']])
                    ->andWhere(['!=', 'id', $model->id])->one();

                    $check_email = User::find()->select(['id', 'email'])->where(['email' => Yii::$app->request->post('User')['email']])
                    ->andWhere(['!=', 'id', $model->id])->one();

                    if (!empty($check_email)) {

                        $check = 0;
                        Yii::$app->session->setFlash('error', 'Даний Email уже зареєстрований у системі!');

                    } elseif (!empty($check_username)) {

                        $check = 0;
                        Yii::$app->session->setFlash('error', 'Даний Логін уже зареєстрований у системі!');

                    }

                    if ($check == 1) {

                        $model->img = UploadedFile::getInstance($model, 'img');

                        if ($model->img) {

                            $extensions = ['png', 'jpg', 'jpeg'];

                            if (in_array($model->img->extension, $extensions)) {

                            	if ($model->img->size < 1024 * 1024 * 2) {

                            		if ($model->image != '/images/_no_user.png') {
	                                    unlink(Yii::$app->basePath . '/web' . $model->image);
	                                }

	                                $hash_id = md5($model->id);
	                                
	                                $model->image = '/uploads/users/' . $hash_id . '.' . $model->img->extension;
	                                $model->upload($hash_id);

                            	} else {
                            		Yii::$app->session->setFlash('error', 'Розмір зображення не повинен перевищувати 2 МіБ.');
                            	}
                            } else {
                                Yii::$app->session->setFlash('error', 'Дозволені файли лише з наступними розширеннями: png, jpg, jpeg.');
                            }
                        }

                        if (Yii::$app->request->post('User')['name']) {
                            $model->name = Yii::$app->request->post('User')['name'];
                            Yii::$app->user->identity->name = $model->name;
                        }
                        
                        $model->username = Yii::$app->request->post('User')['username'];
                        $model->email = Yii::$app->request->post('User')['email'];
                        $model->phone = Yii::$app->request->post('User')['phone'];
                        $model->send_mail = Yii::$app->request->post('User')['send_mail'];

                        Yii::$app->user->identity->username = $model->username;
                        Yii::$app->user->identity->email = $model->email;
                        Yii::$app->user->identity->phone = $model->phone;

                        $model->save();

                        Yii::$app->session->setFlash('success', 'Дані успішно збережено!');
                        
                    }

                }

            endif;

            return $this->render('change-info-about-me', compact('model'));

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionChangeInfoAboutMe();
    }

    public function actionChangePassword()
    {


        if (Yii::$app->user->isGuest) {

            throw new \yii\web\NotFoundHttpException();
    
        } else {
    
            $this->setMeta('Змінити пароль');
            
            $model = new DynamicModel(['old_password', 'new_password', 're_password']);
                $model->addRule(['old_password', 'new_password', 're_password'], 'string', ['max' => 128])
                ->addRule(['old_password'], 'required', ['message' => 'Необхідно заповнити поле "Старий пароль".'])
                ->addRule(['new_password'], 'required', ['message' => 'Необхідно заповнити поле "Новий пароль".'])
                ->addRule(['re_password'], 'required', ['message' => 'Необхідно заповнити поле "Повторіть новий пароль".'])
                ->addRule(['re_password'], 'compare', ['compareAttribute' => 'new_password', 'message' => 'Значення "Повторіть новий пароль" повинно бути рівним "Новий пароль".']);


            if ( Yii::$app->request->post() ) :

                $old_password = Yii::$app->request->post('DynamicModel')['old_password'];
                $new_password = Yii::$app->request->post('DynamicModel')['new_password'];
                $re_password  = Yii::$app->request->post('DynamicModel')['re_password'];

                $user = User::findOne(Yii::$app->user->identity->id);

                if ($user->validatePassword($old_password)) {
                    
                    if ($new_password === $re_password) {

                        $user->password = Yii::$app->security->generatePasswordHash($new_password);
                        $user->real_password = $new_password;

                        if ($user->save()) :
                            Yii::$app->session->setFlash('success', 'Ваш пароль успішно змінено!');
                        endif;
                    
                    } else {
                        Yii::$app->session->setFlash('error', 'Паролі не співпадають!');
                    }

                } else {
                    Yii::$app->session->setFlash('error', 'Старий пароль неправильний!');
                }

            endif;

            return $this->render('change-password', [
                'model' => $model
            ]);
    
        }

        // END public function actionChangePassword() {};
    }

    public function actionFooterModalQuestion()
    {

        if (Yii::$app->request->post()) {

            $type_message = '';
            $user_type = '';

            switch (Yii::$app->request->post('Questions')['type_message']) :
            
                case 'error'    : $type_message = 'Повідомити про помилку'; break;
                case 'idea'     : $type_message = 'Ідеї та побажання';      break;
                case 'complaint': $type_message = 'Поскаржитися';           break;
                case 'other'    : $type_message = 'Інші запитання';         break;
            
            endswitch;

            $user = User::findOne(Yii::$app->user->identity->id);

            $data['message']      = Html::encode(Yii::$app->request->post('Questions')['message']);
            $data['type_message'] = $type_message;
            $data['email']        = Yii::$app->user->identity->email;
            $data['user_id']      = Yii::$app->user->identity->id;
            $data['username']     = Yii::$app->user->identity->username;
            $data['name']         = Yii::$app->user->identity->name;
            $data['phone']        = Yii::$app->user->identity->phone;
            $data['user_type']    = $this->user_type;

            $data['region']   = $user->region->name;
            $data['city']     = $user->city->name;
            $data['school']   = $user->school->name;
            $data['telegram'] = $user->telegram->telegram_chat_id;

            $to   = Yii::$app->params['adminEmail'];
            $from = Yii::$app->params['supportEmail'];

            $mail = Yii::$app->mailer->compose('mail', compact('data'))
            ->setFrom([$from => 'Технічна підтримка School Diary'])
            ->setTo($to)
            ->setSubject('School Diary - Повідомлення в технічну підтримку');

            if ($mail->send()) {

                $question = new Questions();
                
                $question->user_id = Yii::$app->user->identity->id;
                $question->type_message = trim(Yii::$app->request->post('Questions')['type_message']);
                $question->message = $data['message'];
                $question->date = myTime('H') . "\n" . myDate('ua');
             
                if ($question->save()) {

                    $question_id = Yii::$app->db->getLastInsertID();

                    $support = new Support();
                    
                    $support->question_id = $question_id;
                    $support->type_answer = 'user';
                    $support->message = $data['message'];
                    $support->date = time();

                    $support->save();

                }

                $this->__text = urlencode("Вам надіслали листа на пошту: \n\n<b>Тип повідомлення</b>: <code>" . $type_message . "</code> \n<b>ID повідомлення</b>: <code>" . $question_id . "</code> \n<b>Посилання на бесіду</b>: <a>" . Url::to(['/admins/technical-support/view', 'id' => $question_id], true) . "</a> \n\n<b>ID</b>: <code>" . Yii::$app->user->identity->id . "</code> \n<b>Логін</b>: <code>" . Yii::$app->user->identity->username . "</code> \n<b>Email</b>: " . Yii::$app->user->identity->email . " \n<b>Ім'я</b>: <code>" . Yii::$app->user->identity->name . "</code> \n<b>Телефон</b>: <a>" . Yii::$app->user->identity->phone . "</a> \n<b>Telegram ID</b>: <code>" . Yii::$app->user->identity->telegram->telegram_chat_id . "</code> \n<b>Тип користувача</b>: <code>" . Yii::$app->user->identity->custom_type . "</code> \n<b>Школа</b>: <code>" . Yii::$app->user->identity->school->name . "</code> \n<b>Місто</b>: <code>" . Yii::$app->user->identity->city->name . "</code> \n<b>Область</b>: <code>" . Yii::$app->user->identity->region->name . "</code> \n\nЧас: <b>" . myTime() . "</b> \nДата: <b>" . myDate() . "</b>\n\n<b>Повідомлення: </b> \n------------------------\n<code>" . $data['message'] . "</code>");

                $response = $this->curl->get('https://api.telegram.org/bot' . $this->__token_notification . '/sendMessage?text=' . $this->__text . '&chat_id=' . $this->__adminTelegramID . '&parse_mode=HTML');

                Yii::$app->session->setFlash('success', 'Ваше повідомлення було успішно надіслано в технічну підтримку сайта. Дякую за звернення. Адміністрація незабаром зв\'яжеться з Вами!');

                return $this->redirect(['/support/view', 'id' => $question_id]);
            }

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionFooterModalQuestion();

    }

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];

        // END public function behaviors();
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];

        // END public function actions();
    }


	public function actionLogout()
    {

    	if (!Yii::$app->user->isGuest) {

	        Yii::$app->user->logout();

	        return $this->redirect(['/site/login']);
    		
    	} else {

    		throw new \yii\web\NotFoundHttpException();
    		
    	}

        // END public function actionLogout();
    }

}

?>
