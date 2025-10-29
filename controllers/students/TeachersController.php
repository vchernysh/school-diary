<?php

namespace app\controllers\students;

use Yii;
use app\models\Teachers;
use app\models\search\TeachersSearch;
use app\controllers\StudentsController as StudentCONTROLLER;
use yii\web\NotFoundHttpException;

/**
 * TeachersController implements the CRUD actions for Teachers model.
 */
class TeachersController extends StudentCONTROLLER
{

    public function init()
    {
        parent::init();

        if (!$this->__payment_check)
        {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    /**
     * Lists all Teachers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['teachers.school_id' => $this->_school->id])->orderBy(['user.name' => SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teachers model.
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
     * Finds the Teachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teachers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
