<?php

namespace app\controllers\parents;

use Yii;
use app\models\CallsSchedule;
use app\models\search\CallsScheduleSearch;
use app\controllers\ParentsController as ParentCONTROLLER;

/**
 * CallsScheduleController implements the CRUD actions for CallsSchedule model.
 */
class CallsScheduleController extends ParentCONTROLLER
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
