<?php

namespace app\controllers\directors\_teacher;

use Yii;
use app\models\CallsSchedule;
use app\models\search\CallsScheduleSearch;
use app\controllers\DirectorsController;

/**
 * CallsScheduleController implements the CRUD actions for CallsSchedule model.
 */
class CallsScheduleController extends DirectorsController
{

    public function init()
    {
        parent::init();
        
        if (!$this->director_teacher || ($this->school__payment_type == 'all' &! $this->__payment_check)) {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    /**
     * Lists all CallsSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallsScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['calls_schedule.school_id' => $this->_school->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
