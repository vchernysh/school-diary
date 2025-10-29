<?php

namespace app\controllers\teachers\_my_class;

use Yii;
use app\models\{Classes, ClassSubjects, ClassLessonsSchedule};
use app\controllers\TeachersController as TeacherCONTROLLER;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubjectsController implements the CRUD actions for Classes model.
 */
class SubjectsController extends TeacherCONTROLLER
{

    public function init()
    {
        parent::init();
        
        if (!$this->director_teacher || ($this->school__payment_type == 'all' &! $this->__payment_check)) {
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

    public function actionSubjects()
    {
        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) {

            	if (Yii::$app->request->post('action') == 'assigned') {
            		$response = $this->revokeSubject(Yii::$app->request->post());
            	} elseif (Yii::$app->request->post('action') == 'available') {
            		$response = $this->assignSubject(Yii::$app->request->post());
            	}

            	return $response;
            }

            $school_subjects = $this->findModel($this->_class->id)->schoolSubjects;
            $class_subjects = $this->findModel($this->_class->id)->classSubjects;
            
            return $this->render('subjects', [
                'model' => $this->findModel($this->_class->id),
                'subjects' => $school_subjects,
                'class_subjects' => $class_subjects,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    private function revokeSubject($post = [])
    {

    	foreach($post['subjects'] as $subject_id) :

    		$model_ClassSubjects = ClassSubjects::findOne(['class_id' => $this->_class->id, 'subject_id' => $subject_id]);
            $model_ClassSubjects->delete();

            ClassLessonsSchedule::deleteAll(['class_id' => $this->_class->id, 'subject_id' => $subject_id]);

    	endforeach;



        echo json_encode(['subjects' => $post['subjects']]);
    }

    private function assignSubject($post = [])
    {

		foreach($post['subjects'] as $subject_id) :

			$model = new ClassSubjects();
			$model->class_id = $this->_class->id;
			$model->subject_id = $subject_id;
			$model->save();

    	endforeach;
		
        echo json_encode(['subjects' => $post['subjects']]);
    }

    
    /**
     * Finds the Classes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
