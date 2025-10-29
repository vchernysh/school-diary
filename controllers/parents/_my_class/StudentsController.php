<?php

namespace app\controllers\parents\_my_class;

use Yii;
    use app\models\Students;
    use app\models\search\StudentsSearch;
    use app\controllers\ParentsController as ParentCONTROLLER;
    use yii\web\NotFoundHttpException;

/**
 * StudentsController implements the CRUD actions for Students model.
 */
class StudentsController extends ParentCONTROLLER
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
     * Lists all Students models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new StudentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['classes.school_id' => $this->_school->id, 'classes.id' => $this->_class->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Students model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if ($this->findModel($id)->school->id == $this->_school->id && $this->findModel($id)->class->id == $this->_class->id) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
        
    }

    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Students::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
