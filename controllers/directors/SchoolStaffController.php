<?php

namespace app\controllers\directors;

use Yii;
use app\models\SchoolStaff;
use app\models\search\SchoolStaffSearch;
use app\controllers\DirectorsController;
use yii\web\{NotFoundHttpException, UploadedFile};
use yii\filters\VerbFilter;

/**
 * SchoolStaffController implements the CRUD actions for SchoolStaff model.
 */
class SchoolStaffController extends DirectorsController
{

    public function init()
    {
        parent::init();

        if ($this->school__payment_type == 'all' &! $this->__payment_check)
        {
            throw new \yii\web\NotFoundHttpException();
        }
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
     * Lists all SchoolStaff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolStaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['school_staff.school_id' => $this->_school->id])->orderBy(['school_staff.name' => SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SchoolStaff model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {
            
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Creates a new SchoolStaff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SchoolStaff();

        if ($model->load(Yii::$app->request->post())) {
        	
        	$model->school_id = $this->_school->id;
        	$model->image = '/images/_no_user.png';

        	$model->birthday = (Yii::$app->request->post('SchoolStaff')['birthday_string']) ? strtotime(Yii::$app->request->post('SchoolStaff')['birthday_string']) : NULL;

        	$check = false;
        	$pass = true;

            $model->img = UploadedFile::getInstance($model, 'img');

            if ($model->img) {

            	$pass = false;

                $extensions = ['png', 'jpg', 'jpeg'];

                if (in_array($model->img->extension, $extensions)) {

                    if ($model->img->size < 1024 * 1024 * 2) {
                    	$check = true;
                    	$pass = true;
                    } else {
                        Yii::$app->session->setFlash('error', 'Розмір зображення не повинен перевищувати 2 МіБ.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Дозволені файли лише з наступними розширеннями: png, jpg, jpeg.');
                }
            }

            if ($pass) {

            	if ($model->save()) {

	            	if ($check) {

						$hash_id = md5($model->id);

						$model->image = '/uploads/school-staff/' . $hash_id . '.' . $model->img->extension;
						$model->upload($hash_id);

						$model->save();

	            	}

	                return $this->redirect(['view', 'id' => $model->id]);

            	}

            }
        }

        return $this->render('create', [
            'model' => $model,
            'request' => Yii::$app->request->post('SchoolStaff'),
        ]);
    }

    /**
     * Updates an existing SchoolStaff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {
            
            $model = $this->findModel($id);

            if (Yii::$app->request->post('remove-image')) {

                unlink(Yii::$app->basePath . '/web' . $model->image);

                $model->image = '/images/_no_user.png';

                $model->save();

                Yii::$app->session->setFlash('success', 'Зображення успішно видалено!');

            }

            if ($model->load(Yii::$app->request->post())) {

            	$model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;

                $model->img = UploadedFile::getInstance($model, 'img');

                if ($model->img) {

                    $extensions = ['png', 'jpg', 'jpeg'];

                    if (in_array($model->img->extension, $extensions)) {

                        if ($model->img->size < 1024 * 1024 * 2) {

                            if ($model->image != '/images/_no_user.png') {
                                unlink(Yii::$app->basePath . '/web' . $model->image);
                            }

                            $hash_id = md5($model->id);
                            
                            $model->image = '/uploads/school-staff/' . $hash_id . '.' . $model->img->extension;
                            $model->upload($hash_id);

                        } else {
                            Yii::$app->session->setFlash('error', 'Розмір зображення не повинен перевищувати 2 МіБ.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Дозволені файли лише з наступними розширеннями: png, jpg, jpeg.');
                    }
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'request' => Yii::$app->request->post('SchoolStaff'),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Deletes an existing SchoolStaff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {
            
            if ($this->findModel($id)->image != '/images/_no_user.png') {
                unlink(Yii::$app->basePath . '/web' . $this->findModel($id)->image);
            }

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Finds the SchoolStaff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolStaff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolStaff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
