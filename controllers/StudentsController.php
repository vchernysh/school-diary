<?php

namespace app\controllers;

use Yii;
    use yii\helpers\Url;
    use app\models\InfoAboutSchool;


class StudentsController extends AppController
{
    protected $_school, $_class;

    public function init()
    {
        parent::init();

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->type != 'student')
        {
            throw new \yii\web\NotFoundHttpException();
        }

        $this->_school = Yii::$app->user->identity->school; // School of student
        $this->_class = Yii::$app->user->identity->student_class; // Class of student

        Url::remember();

        // END public function init();
    }

    public function actionIndex()
    {

        $this->setMeta('Учні');

        $school = InfoAboutSchool::findOne(['school_id' => $this->_school->id]);

        if (!$school['info']) {
            $school['info'] = '<i class="not-set">Інформація про дану школу відсутня. Заповнити її може лише директор. Очікуйте.</i>';
        }

        return $this->render('index', compact('school'));

        // END public function actionIndex();
    }

    // END class StudentsController;
}
