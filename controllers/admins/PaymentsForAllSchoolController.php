<?php

namespace app\controllers\admins;

use Yii;
use app\models\{PaymentsForAllSchool, Schools, Cities};
use app\models\search\PaymentsForAllSchoolSearch;
use app\controllers\AdminsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsForAllSchoolController implements the CRUD actions for PaymentsForAllSchool model.
 */
class PaymentsForAllSchoolController extends AdminsController
{
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
     * Lists all PaymentsForAllSchool models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsForAllSchoolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentsForAllSchool model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionGetSchoolInfo($id) 
    {

        if (Yii::$app->request->isAjax) {

            $school = Schools::findOne($id);

            echo json_encode(['amount' => $school->price_for_all_school, 'currency' => $school->currency->name]);

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionGetCities($id)
    }

    /**
     * Creates a new PaymentsForAllSchool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentsForAllSchool();

        $schools_info = Schools::find()->select('id, name, city_id, max_students')->where(['!=', 'id', 1])->andWhere(['payment_for_school' => 'all'])->all();
        $schools = [];
        foreach($schools_info as $key => $school) :
            $city = Cities::findOne(['id' => $school->city_id])->name;
            $schools[$city][$school->id] = $school->name . ' — ' . number_format($school->max_students, 0, ',', ' ') . ' учнів';
        endforeach;

        if ($model->load(Yii::$app->request->post()))
        {

            $unix_time = time();
            $date_to = strtotime($model->date_to);
            $model->date_from = myDate();
            $model->date_to = myDate('ua', $date_to);
            $model->unix_date_to = $date_to;
            $model->unix_date_from = $unix_time;

            if ($model->save())
            {
                Yii::$app->session->setFlash('success', '<strong>Вітаю!</strong> Оплату  на суму <strong>' . number_format($model->amount, 2, ',', ' ') . $model->school->currency->name . '</strong> успішно створено для <strong>' . $model->school->name . '</strong>!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'schools' => $schools
        ]);
    }

    /**
     * Updates an existing PaymentsForAllSchool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $schools_info = Schools::find()->select('id, name, city_id, max_students')->where(['!=', 'id', 1])->andWhere(['payment_for_school' => 'all'])->all();
        $schools = [];
        foreach($schools_info as $key => $school) :
            $city = Cities::findOne(['id' => $school->city_id])->name;
            $schools[$city][$school->id] = $school->name . ' — ' . number_format($school->max_students, 0, ',', ' ') . ' учнів';
        endforeach;

        if ($model->load(Yii::$app->request->post())) {

            $date_to = strtotime($model->date_to);
            $model->date_to = myDate('ua', $date_to);
            $model->unix_date_to = $date_to;

            if ($model->save())
            {
                Yii::$app->session->setFlash('success', '<strong>Вітаю!</strong> Оплату  на суму <strong>' . number_format($model->amount, 2, ',', ' ') . $model->school->currency->name . '</strong> успішно змінено для <strong>' . $model->school->name . '</strong>!');
                return $this->redirect(['view', 'id' => $model->id]);
            }


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'schools' => $schools
        ]);
    }

    /**
     * Deletes an existing PaymentsForAllSchool model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaymentsForAllSchool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PaymentsForAllSchool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentsForAllSchool::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
