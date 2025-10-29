<?php

namespace app\controllers\students;

use Yii;
use app\models\SchoolStaff;
use app\models\search\SchoolStaffSearch;
use app\controllers\StudentsController as StudentCONTROLLER;
use yii\web\NotFoundHttpException;

/**
 * SchoolStaffController implements the CRUD actions for SchoolStaff model.
 */
class SchoolStaffController extends StudentCONTROLLER
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
