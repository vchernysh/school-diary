<?php

namespace app\controllers;

use Yii;
    use yii\helpers\Url;
    use app\models\{InfoAboutSchool, Schools};

class TeachersController extends AppController
{
    protected $_school, $_class;
    public $_count_students;

    public function init()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }
        parent::init();

        $this->_school = Yii::$app->user->identity->school; // School of teacher
        $this->_class = Yii::$app->user->identity->class; // Class of teacher
        $this->_count_students = Schools::getCountOfAllStudentsBySchool($this->_school->id); // Count students of school

        Url::remember();

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->type != 'teacher')
        {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function init();
    }

    public function actionIndex()
    {

        $this->setMeta('Вчителі');

        $school = InfoAboutSchool::findOne(['school_id' => $this->_school->id]);

        if (!$school['info']) {
            $school['info'] = '<i class="not-set">Інформація про дану школу відсутня. Заповнити її може лише директор. Очікуйте.</i>';
        }

        return $this->render('index', compact('school'));

        // END public function actionIndex();
    }

    // END class TeachersController;
}
