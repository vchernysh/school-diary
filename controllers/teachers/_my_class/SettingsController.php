<?php

namespace app\controllers\teachers\_my_class;

use Yii;
use app\models\{Classes, Subjects, ClassTeachersAccess, ClassTeachersSubjectsAccess};
use app\controllers\TeachersController as TeacherCONTROLLER;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScheduleController implements the CRUD actions for Classes model.
 */
class SettingsController extends TeacherCONTROLLER
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

    public function actionIndex()
    {

        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            foreach ($this->findModel($this->_class->id)->classTeachersAccess as $teacher) :
                
                $subjects = [];
                $classTeachersSubjectsAccess = Subjects::find()
                    ->innerJoin('class_teachers_subjects_access', 'class_teachers_subjects_access.subject_id = subjects.id')
                    ->where([
                        'class_id' => $this->_class->id,
                        'teacher_id' => $teacher->id])
                    ->asArray()
                    ->all();

                if ($classTeachersSubjectsAccess) {
                    foreach($classTeachersSubjectsAccess as $subject) :
                        $subjects[] = $subject['subject_name'];
                    endforeach;
                }

                $classTeachersAccess[$teacher->id] = [
                    'id' => $teacher->id,
                    'name' => $teacher->name . ' - ' . $teacher->subject->subject,
                    'subjects' => $subjects,
                ];

            endforeach;

            $model = $this->findModel($this->_class->id);
            $model->teachers_subjects = $classTeachersAccess;

            return $this->render('index', [
                'model' => $model,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionEdit()
    {
        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            $model = $this->findModel($this->_class->id);

            if ($model->load(Yii::$app->request->post())) {

                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Налаштування збережені!');
                    return $this->redirect(['index']);
                }
            }

            return $this->render('edit', [
                'model' => $model,
                'request' => Yii::$app->request->post('Classes'),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionTeachersSubjectsAccess()
    {
        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) :
                $subjects = ClassTeachersSubjectsAccess::find()
                    ->where([
                        'class_id' => Yii::$app->request->post('class_id'),
                        'teacher_id' => Yii::$app->request->post('teacher_id')])
                    ->asArray()->all();
                
                echo json_encode(['subjects' => $subjects]);
                return;
            endif;

            $another_model = new ClassTeachersSubjectsAccess();

            if ($another_model->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post('ClassTeachersSubjectsAccess');
                $classTeachersSubjectsAccess_model = ClassTeachersSubjectsAccess::find()
                    ->where([
                        'class_id' => $post['class_id'],
                        'teacher_id' => $post['teacher_id']])
                    ->all();

                foreach($classTeachersSubjectsAccess_model as $remove_model) :
                    $remove_model->delete();
                endforeach;

                foreach($post['subjects'] as $subject_id) :
                    $save_model = new ClassTeachersSubjectsAccess();
                    $save_model->class_id = $post['class_id'];
                    $save_model->teacher_id = $post['teacher_id'];
                    $save_model->subject_id = $subject_id;
                    $save_model->save();
                endforeach;

                Yii::$app->session->setFlash('success', 'Налаштування збережені!');
                return $this->refresh();
            }

            $class_subjects = $this->findModel($this->_class->id)->classSubjects;
            foreach ($this->findModel($this->_class->id)->classTeachersAccess as $teacher) :
                $classTeachersAccess[] = [
                    'id' => $teacher->id,
                    'name' => '• ' . $teacher->name . ' - ' . $teacher->subject->subject
                ];
            endforeach;

            return $this->render('teachers-subjects-access', [
                'model' => $this->findModel($this->_class->id),
                'another_model' => $another_model,
                'class_teachers_access' => $classTeachersAccess,
                'class_subjects' => $class_subjects,
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionTeachersAccess()
    {

        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) {

                if (Yii::$app->request->post('action') == 'assigned') {
                    $response = $this->revokeClassTeacherAccess(Yii::$app->request->post());
                } elseif (Yii::$app->request->post('action') == 'available') {
                    $response = $this->assignClassTeacherAccess(Yii::$app->request->post());
                }

                return $response;
            }

            $classTeachersAccess = $this->findModel($this->_class->id)->classTeachersAccess;
            $school_teachers = $this->findModel($this->_class->id)->schoolTeachers;
            
            return $this->render('teachers-access', [
                'model' => $this->findModel($this->_class->id),
                'teachers' => $school_teachers,
                'class_teachers_access' => $classTeachersAccess,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    private function assignClassTeacherAccess($post = [])
    {
        foreach($post['teachers'] as $teacher_id) :

            $model = new ClassTeachersAccess();
            $model->class_id = $post['class_id'];
            $model->teacher_id = $teacher_id;
            $model->save();

        endforeach;
        
        echo json_encode(['teachers' => $post['teachers']]);
    }

    private function revokeClassTeacherAccess($post = [])
    {
        foreach($post['teachers'] as $teacher_id) :

            $model_ClassTeachersAccess = ClassTeachersAccess::findOne(['class_id' => $post['class_id'], 'teacher_id' => $teacher_id]);
            $model_ClassTeachersAccess->delete();

            ClassTeachersSubjectsAccess::deleteAll(['class_id' => $post['class_id'], 'teacher_id' => $teacher_id]);

        endforeach;

        echo json_encode(['teachers' => $post['teachers']]);
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
