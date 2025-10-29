<?php

namespace app\controllers\admins;

use Yii;
use app\models\{Schools, Regions, Cities, User, Directors, Teachers, InfoAboutSchool, Classes, Subjects, ClassTeachersAccess, ClassTeachersSubjectsAccess, Currencies};
use app\models\search\SchoolsSearch;
use app\controllers\AdminsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SchoolsController implements the CRUD actions for Schools model.
 */
class SchoolsController extends AdminsController
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
     * Lists all Schools models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new SchoolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetCities($id) 
    {

        if (Yii::$app->request->isAjax) {

            $cities = Cities::find()->where(['region_id' => $id])->orderBy('name ASC')->all();
            
            if (!empty($cities)) {
            
                echo '<option selected disabled>Виберіть місто</option>';
          
                foreach($cities as $city) :
                    echo '<option value="' . $city->id . '">' . $city->name . '</option>';
                endforeach;
            
            } else {
                echo '<option selected disabled>Немає жодного міста по заданій області</option>';
            }

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionGetCities($id)
    }

    public function actionGetDirectors($id, $school_id = null) 
    {

        if (Yii::$app->request->isAjax) {
        
            $directors = User::find()
                ->leftJoin('directors', 'user.id = directors.user_id')
                ->select(['id', 'name'])
                ->where(['is', 'directors.user_id', null])
                ->andWhere(['user.type' => 'director'])
                ->all();

            if (!is_null($school_id)) {
                $selected_director = User::find()
                    ->innerJoin('directors', 'directors.user_id = user.id')
                    ->innerJoin('schools', 'schools.id = directors.school_id')
                    ->where(['schools.id' => $school_id])
                    ->one();
            }
            
            if (!empty($directors)) {
                if (!is_null($school_id)) {   
                    if ($selected_director) {
                        echo '<option selected value="' . $selected_director->id . '">' . $selected_director->name . '</option>';
                    }
                }
                foreach($directors as $director) :
                    echo '<option value="' . $director->id . '">' . $director->name . '</option>';
                endforeach;

            } else {
                if (!is_null($school_id)) {
                    if ($selected_director) {
                        echo '<option selected value="' . $selected_director->id . '">' . $selected_director->name . '</option>';
                    } else {
                        echo '<option selected disabled>Немає зареєстрованих директорів. Для початку створіть директора</option>';
                    }
                } else {
                    echo '<option selected disabled>Немає зареєстрованих директорів. Для початку створіть директора</option>';
                }
            }

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // public function actionGetDirector($id) 
    }

    /**
     * Displays a single Schools model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionGetSubjectField($check)
    {

        if (Yii::$app->request->isAjax) {

            $response = '';

            if ($check == 0) {
                $response = 0;
            } else {
                $response = '<div class="form-group field-schools-teacher_subject">
                    <label class="control-label" for="schools-teacher_subject">Предмет</label>
                    <input type="text" required="" id="schools-teacher_subject" class="form-control" name="Schools[teacher_subject]">
                    <div class="help-block"></div>
                    </div>';
            }

            echo $response;

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

    }

    /**
     * Creates a new Schools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schools();

        $regions = Regions::find()->all();
        $currencies_list = Currencies::find()->all();

        $currencies = [];

        foreach($currencies_list as $key => $currency) :

            $currencies[$key]['id'] = $currency->id;
            $currencies[$key]['name'] = $currency->name . ' — ' . $currency->symbol . ' (' . $currency->country . ')';

        endforeach;

        if ($model->load(Yii::$app->request->post())) {

            $director_id = Yii::$app->request->post('Schools')['director_id'];
            $city_id = Yii::$app->request->post('Schools')['city_id'];
            $name = Yii::$app->request->post('Schools')['name'];


            $payment_for_school = Yii::$app->request->post('Schools')['payment_for_school'];
            $price = Yii::$app->request->post('Schools')['price'];
            $price_for_all_school = Yii::$app->request->post('Schools')['price_for_all_school'];
            $max_students = Yii::$app->request->post('Schools')['max_students'];
            
            $model->payment_for_school = $payment_for_school;

            if ($payment_for_school == 'single')
            {
            	$model->price = $price;
            	$model->price_for_all_school = NULL;
            	$model->max_students = NULL;
            } elseif ($payment_for_school == 'all')
            {
            	$model->price = NULL;
            	$model->price_for_all_school = $price_for_all_school;
            	$model->max_students = $max_students;
            }

            $model->city_id = $city_id;
            $model->name = $name;
            
            if ($model->save()) {

                $last_inserted_id = Yii::$app->db->getLastInsertID();

                $model_info = new InfoAboutSchool();
                $model_info->school_id = $last_inserted_id;

                if ($model_info->save()) {

                    $directors_model = new Directors();

                    $directors_model->user_id = $director_id;
                    $directors_model->school_id = $last_inserted_id;

                    $check = Yii::$app->request->post('Schools')['if_director_can_be_teacher'];

                    if ($check == 1) {

                        $subject = Yii::$app->request->post('Schools')['teacher_subject'];

                        if (empty($subject)) {
                            $subject = NULL;
                        }

                        $params = [':user_id' => $director_id, ':school_id' => $last_inserted_id, ':subject' => $subject];

                        Yii::$app->db->createCommand('INSERT INTO `teachers` (user_id, school_id, subject) VALUES (:user_id, :school_id, :subject)')
                            ->bindValues($params)
                            ->execute();
                    }

                    if ($directors_model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                }

            }
        }

        return $this->render('create', [
            'model' => $model,
            'regions' => $regions,
            'directors' => [],
            'currencies' => $currencies
        ]);
    }

    /**
     * Updates an existing Schools model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $dir_id = $model->director->id;

        $regions = Regions::find()->all();
        $cities = Cities::find()->where(['region_id' => $model->region->id])->select(['id', 'name'])->orderBy('name ASC')->all();

        $directors = User::find()
            ->leftJoin('directors', 'user.id = directors.user_id')
            ->select(['user.id', 'user.name'])
            ->andWhere(['is', 'directors.user_id', null])
            ->andWhere(['user.type' => 'director'])
            ->orWhere(['directors.school_id' => $model->id])
            ->all();

        $director_teacher = Teachers::findOne(['user_id' => $model->director->id]);

        $currencies_list = Currencies::find()->all();

        $currencies = [];

        foreach($currencies_list as $key => $currency) :

            $currencies[$key]['id'] = $currency->id;
            $currencies[$key]['name'] = $currency->name . ' — ' . $currency->symbol . ' (' . $currency->country . ')';

        endforeach;

        if ($model->load(Yii::$app->request->post())) {

            $director_id = Yii::$app->request->post('Schools')['director_id'];
            $city_id = Yii::$app->request->post('Schools')['city_id'];
            $name = Yii::$app->request->post('Schools')['name'];

            $payment_for_school = Yii::$app->request->post('Schools')['payment_for_school'];
            $price = Yii::$app->request->post('Schools')['price'];
            $price_for_all_school = Yii::$app->request->post('Schools')['price_for_all_school'];
            $max_students = Yii::$app->request->post('Schools')['max_students'];
            
            $model->payment_for_school = $payment_for_school;

            if ($payment_for_school == 'single')
            {
            	$model->price = $price;
            	$model->price_for_all_school = NULL;
            	$model->max_students = NULL;
            } elseif ($payment_for_school == 'all')
            {
            	$model->price = NULL;
            	$model->price_for_all_school = $price_for_all_school;
            	$model->max_students = $max_students;
            }

            $model->city_id = $city_id;
            $model->name = $name;
            
            if ($model->save()) {
                $directors_model = Directors::findOne(['school_id' => $model->id]);
                $directors_model->user_id = $director_id;

                if ($director_teacher) {
                    Teachers::findOne(['user_id' => $dir_id, 'school_id' => $model->id])->delete();
                }

                $check = Yii::$app->request->post('Schools')['if_director_can_be_teacher'];

                if ($check == 1) {
                        
                    $subject = Yii::$app->request->post('Schools')['teacher_subject'];

                    if (empty($subject)) {
                        $subject = NULL;
                    }

                    $params = [':user_id' => $director_id, ':school_id' => $model->id, ':subject' => $subject];

                    Yii::$app->db->createCommand('INSERT INTO `teachers` (user_id, school_id, subject) VALUES (:user_id, :school_id, :subject)')
                        ->bindValues($params)
                        ->execute();
                } else {
                    $teacher = Teachers::findOne(['user_id' => $director_id]);
                    if ($teacher) {
                        $teacher->delete();
                    }
                    ClassTeachersAccess::deleteAll(['teacher_id' => $director_id]);
                    ClassTeachersSubjectsAccess::deleteAll(['teacher_id' => $director_id]);

                    $class_teacher_check = Classes::findOne(['class_teacher_id' => $director_id]);
                    if ($class_teacher_check) {

                        $params_class_teacher = [':class_teacher_id' => null];

                        Yii::$app->db->createCommand('UPDATE `classes` SET `class_teacher_id` = :class_teacher_id WHERE `class_teacher_id` = "' . $director_id . '"')
                            ->bindValues($params_class_teacher)
                            ->execute();
                    }
                }

                if ($directors_model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'regions' => $regions,
            'cities' => $cities,
            'directors' => $directors,
            'director_teacher' => $director_teacher,
            'currencies' => $currencies
        ]);
    }

    /**
     * Deletes an existing Schools model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $school_name = $this->findModel($id)->name;
        Schools::removeSchool($id);
        Yii::$app->session->setFlash('success', 'Навчальний заклад "' . $school_name . '" успішно видалений з системи!');

       return $this->redirect(['index']);
    }

    /**
     * Finds the Schools model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schools the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schools::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
