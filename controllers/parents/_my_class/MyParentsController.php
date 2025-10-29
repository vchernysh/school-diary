<?php

namespace app\controllers\parents\_my_class;

use Yii;
    use app\models\Parents;
    use app\models\search\ParentsSearch;
    use app\controllers\ParentsController as ParentCONTROLLER;
    use yii\web\NotFoundHttpException;

/**
 * ParentsController implements the CRUD actions for Parents model.
 */
class MyParentsController extends ParentCONTROLLER
{

    public function init()
    {
        throw new \yii\web\NotFoundHttpException();
        parent::init();
    }

    /**
     * Lists all Parents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['classes.school_id' => $this->_school->id, 'classes.id' => $this->_class->id, 'parents.student_id' => Yii::$app->user->identity->id])->orderBy(['user.name' => SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parents model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

    	if ($this->findModel($id)->school->id == $this->_school->id && $this->findModel($id)->class->id == $this->_class->id && $this->findModel($id)->student_id == Yii::$app->user->identity->id) {

	    	$parent = [];

	    	switch ($this->findModel($id)->type) :
	    		case 'mother':
	    			$parent['info_about_parent'] = 'матір';
	    			$parent['label_parent'] = 'матері';
	    			break;
	    		case 'father':
	    			$parent['info_about_parent'] = 'батька';
	    			$parent['label_parent'] = 'батька';
	    			break;
	    		case 'sister':
	    			$parent['info_about_parent'] = 'сестру';
	    			$parent['label_parent'] = 'сестри';
	    			break;
	    		case 'brother':
	    			$parent['info_about_parent'] = 'брата';
	    			$parent['label_parent'] = 'брата';
	    			break;
	    		case 'grandmother':
	    			$parent['info_about_parent'] = 'бабусю';
	    			$parent['label_parent'] = 'бабусі';
	    			break;
	    		case 'grandfather':
	    			$parent['info_about_parent'] = 'дідуся';
	    			$parent['label_parent'] = 'дідуся';
	    			break;
	    	endswitch;

	        return $this->render('view', [
	            'model' => $this->findModel($id),
	            'parent' => $parent,
	        ]);

	    }

	    throw new \yii\web\NotFoundHttpException();

    }

    /**
     * Finds the Parents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
