<?php

namespace app\controllers\app;

use Yii;
use yii\helpers\{Url, Html};
use app\models\{Orders, Payments, Liqpay as LiqPay_Model};
use app\models\liqpay\LiqPay_API as LiqPay;
use app\models\search\PaymentsSearch;
use app\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupportController implements the CRUD actions for Questions model.
 */
class PaymentsController extends AppController
{

	public function init()
    {
        parent::init();

        if ($this->school__payment_type == 'all') {
            throw new \yii\web\NotFoundHttpException();
        }

        Url::remember();

        if (Yii::$app->user->isGuest || !Yii::$app->user->identity)
        {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function init();
    }

    public function beforeAction($action)
	{
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex()
    {

        if ((Yii::$app->user->identity->type == 'student' || Yii::$app->user->identity->type == 'parent') && Yii::$app->user->identity->school->is_test == 'no')
        {

            $liqpay_form = '';
            if ($this->__payment_check) {
                $liqpay_form = '';
            } else {
                $liqpay_form = $this->renderAjax('_ajax_liqpay_form', ['amount' => $this->__amount, 'currency' => $this->__currency->name]);
            }

            if (Yii::$app->request->isPost) :

                if (Yii::$app->request->origin == $this->_LIQPAY_domain)
                {
                    $data = Yii::$app->request->post('data');
                    $sign = base64_encode(sha1($this->_LIQPAY_private_key .  $data . $this->_LIQPAY_private_key, 1));

                    if ($sign == Yii::$app->request->post('signature')) :
                        
                        $liqpay_response = json_decode(base64_decode($data));
                    
                        $flash_type = 'error';
                        $flash_text = '';

                        switch ($liqpay_response->status) :
                            
                            case 'success':
                                $flash_type = 'success';
                                $flash_text = '<strong>№ ' . $liqpay_response->payment_id . ' - Платіж пройшов успішно</strong>. Ви оплатили користування сервісом <strong>School Diary</strong> для учня <strong>' . Yii::$app->user->identity->name . '</strong>!';
                                break;

                            case 'sandbox':
                                $flash_type = 'info';
                                $flash_text = '<strong>№ ' . $liqpay_response->payment_id . ' - Тестовий платіж пройшов успішно</strong>. Ви оплатили користування сервісом <strong>School Diary</strong> для учня <strong>' . Yii::$app->user->identity->name . '</strong>!';
                                break;

                            case 'error':
                                $flash_text = '<strong>Неуспішний платіж</strong>. Некоректно заповнені дані.';
                            
                                break;

                            case 'failure':
                                $flash_text = '<strong>Неуспішний платіж</strong>. Зверніться до адміністрації сайту, щоб дізнатися причину.';
                            
                                break;

                            case 'reversed':
                                $flash_type = 'info';
                                $flash_text = '<strong>Платіж повернутий</strong>. Зверніться до адміністрації сайту, щоб дізнатися причину.';
                            
                                break;

                            case 'wait_accept':
                                $flash_type = 'warning';
                                $flash_text = '<strong>Кошти списані</strong>. Платіж на перевірці. Очікуйте.';
                                break;

                            case 'wait_secure':
                                $flash_type = 'warning';
                                $flash_text = '<strong>Платіж на перевірці</strong>. Очікуйте.';
                                break;

                        endswitch;

                        Yii::$app->session->setFlash($flash_type, $flash_text);

                    endif;
                    
                }

            endif;

            $searchModel = new PaymentsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['a_payments.student_id' => Yii::$app->user->identity->studentIDViaPayment]);

            $student_name = '';
            if (Yii::$app->user->identity->type == 'parent')
            {
                $student_name = Yii::$app->user->identity->children->name;
            } elseif (Yii::$app->user->identity->type == 'student') 
            {
                $student_name = Yii::$app->user->identity->name;
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'liqpay_form' => $liqpay_form,
                'student_name' => $student_name,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();

    }

    public function actionAddNewOrder()
    {

    	if (Yii::$app->request->isAjax)
		{
			if (Yii::$app->request->post('action') == 'addNewOrder')
			{

				$order = new Orders();

				$student_id = '';
                $student_name = '';
				
				if (Yii::$app->user->identity->type == 'parent') 
				{
					$student_id = Yii::$app->user->identity->children->user_id;
                    $student_name = Yii::$app->user->identity->children->name;
                    
                } elseif (Yii::$app->user->identity->type == 'student')
                {
                    $student_id = Yii::$app->user->identity->id;
                    $student_name = Yii::$app->user->identity->name;
				}

				$order->payer_id = Yii::$app->user->identity->id;
				$order->student_id = $student_id;
				$order->status = 'new';
				$order->currency = $this->__currency->name;
				$order->amount = $this->__amount;
				$order->date = time();

				if ($order->save()) 
				{
					$order_id = Yii::$app->db->getLastInsertID();

					$liqpay = new LiqPay($this->_LIQPAY_public_key, $this->_LIQPAY_private_key);

			        $array = [
			            'action'      => 'pay',
			            'amount'      => $this->__amount,
			            'currency'    => $this->__currency->name,
			            'description' => $student_name . ' - Оплата за учня в електронному журналі School Diary. Термін - до ' . myDate('ua', getDateOfNextYearIfThisDayHasNotPass('01-06')),
			            'order_id'    => $order_id,
			            'version'     => '3',
			            'server_url'  => 'https://checkout.school-diary.io/checkout.php', // where result is processing (де обробляються дані)
			            'result_url'  => Url::to(['/payments'], true), // click back
			            'language'    => 'uk',
			            'sandbox'     => 1,
			            'public_key'  => $this->_LIQPAY_public_key,
			        ];

					$data = base64_encode(json_encode($array));
					$signature = $liqpay->str_to_sign($this->_LIQPAY_private_key . $data . $this->_LIQPAY_private_key);
                    
                    return json_encode([
                    	'action_form' => $this->_LIQPAY_CHECKOUT,
                    	'data' => $data,
                    	'signature' => $signature,
                    ]);
				}
			}
		}

    	throw new \yii\web\NotFoundHttpException();
    }


    public function actionView($order_id)
    {
        if (Yii::$app->user->identity->type == 'student' || Yii::$app->user->identity->type == 'parent')
        {
            $check = false;
            if (Yii::$app->user->identity->type == 'student')
            {
                if ($this->findModel($order_id)->student_id == Yii::$app->user->identity->id) {
                    $check = true;
                }
            } elseif (Yii::$app->user->identity->type == 'parent')
            {
                if ($this->findModel($order_id)->student_id == Yii::$app->user->identity->children->user_id) {
                    $check = true;
                }
            }
            if ($check)
            {
                return $this->render('view', ['model' => $this->findModel($order_id)]);
            }
        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne(['order_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
