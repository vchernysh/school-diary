<?php

namespace app\controllers;

use Yii;
    use yii\helpers\Url;
    use app\models\{Schools, Teachers, Students, Parents, Classes, User, Directors, Payments, Liqpay, Currencies};


class AdminsController extends AppController
{

    public function init()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        parent::init();

        Url::remember();

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->type != 'admin')
        {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function init();
    }

    public function actionIndex()
    {

        $this->setMeta('Адміністратор');

        $data['schools_count'] = Schools::find()->count()-1;
        $data['directors_count'] = Directors::find()->count()-1;
        $data['teachers_count'] = Teachers::find()->count();
        $data['students_count'] = Students::find()->count();
        $data['parents_count'] = Parents::find()->count();
        $data['classes_count'] = Classes::find()->count();
        $data['users_count'] = User::find()->count()-1;
        $data['payments_count'] = Payments::find()->count();
        $sums = [];
        $currencies = Liqpay::find()->select('currency')->distinct()->all();
        $symbols = [];
        
        foreach($currencies as $key => $currency) :
        	$sums[$currency->currency]['amount_without_receiver_commission'] = Liqpay::find()->where(['currency' => $currency->currency, 'status' => 'sandbox'])->sum('amount');
        	$sums[$currency->currency]['amount_with_receiver_commission'] = Liqpay::find()->where(['currency' => $currency->currency, 'status' => 'sandbox'])->sum('amount_with_receiver_commission');
        	$sums[$currency->currency]['receiver_commission'] = Liqpay::find()->where(['currency' => $currency->currency, 'status' => 'sandbox'])->sum('receiver_commission');

        	$symbols[$currency->currency] = Currencies::findOne(['name' => $currency->currency])->symbol;
        endforeach;

        return $this->render('index', compact('data', 'sums', 'symbols'));

        // END public function actionIndex();
    }

    // END class AdminsController;
}
