<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;

class Schools extends ActiveRecord
{

    public $director_id, $if_director_can_be_teacher, $teacher_subject, $region_id;

    public static function tableName()
    {

        return 'schools';

        // END public static function tableName();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва',
            'director_id' => 'Директор',
            'director_name' => 'Директор',
            'city_id' => 'Місто',
            'city_name' => 'Місто',
            'region_id' => 'Область',
            'region_name' => 'Область',
            'if_director_can_be_teacher' => 'Директор може бути вчителем?',
            'teacher_subject' => 'Профільний предмет директора',
            'price' => 'Ціна за учня',
            'is_test' => 'Тест?',
            'custom_test_type' => 'Тест?',
            'payment_for_school' => 'Оплата за школу',
            'custom_payment_for_school' => 'Оплата за школу',
            'price_for_all_school' => 'Ціна за всю школу',
            'school_currency_ID' => 'Валюта',
            'max_students' => 'Макс. кількість учнів',
        ];
    }

    public function rules()
    {
        return [
            [['id', 'price', 'price_for_all_school', 'school_currency_ID', 'max_students'], 'integer'],
            [['name', 'city_id', 'payment_for_school'], 'required'],
            ['is_test', 'required', 'message' => 'Необхідно вибрати "Тест?".'],
            ['region_id', 'required', 'message' => 'Необхідно вибрати "Область".'],
            ['director_id', 'required', 'message' => 'Необхідно вибрати "Директора".'],
            ['if_director_can_be_teacher', 'required', 'message' => 'Необхідно визначити, чи може директор бути вчителем.'],
            [['name', 'region_name', 'city_name', 'city_id', 'region_id', 'director_name', 'director_id', 'teacher_subject', 'is_test', 'payment_for_school'], 'string'],
            [['custom_test_type', 'custom_payment_for_school'], 'safe'],
        ];
    }

    public function getRegion()
    {
        // return $this->hasOne(Regions::className(), ['id' => 'region_id']);
        return $this->hasOne(Regions::className(), ['id' => 'region_id'])
            ->via('city');
    }

    public function getRegion_name()
    {
        return $this->region->name;
    }

    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getCity_name()
    {
        return $this->city->name;
    }

    public function getDirector()
    {   
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->viaTable('directors', ['school_id' => 'id']);
    }

    public function getCurrency()
    {   
        return $this->hasOne(Currencies::className(), ['id' => 'school_currency_ID']);
    }

    public function getDirector_name()
    {
        return $this->director->name;
    }

    public function getTeacherDirector()
    {
        return Teachers::className()::findOne(['user_id' => $this->director->id]);
    }

    public function getCyrillic_test_type()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'is_test']);
    }

    public function getCustom_test_type()
    {
        return $this->cyrillic_test_type->cyrillic_name;
    }

    public function getCyrillic_payment_for_school()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'payment_for_school']);
    }

    public function getCustom_payment_for_school()
    {
        return $this->cyrillic_payment_for_school->cyrillic_name;
    }

    public function getAllUsersBySchool($id)
    {
        $users = [];

        $classes = Classes::className()::find()->where(['school_id' => $id])->all();
        foreach($classes as $key => $class) :
            $students = Students::className()::find()->where(['class_id' => $class->id])->all();
            foreach($students as $key => $student) :
                $users['students'][] = $student->user_id;
                $parents = Parents::className()::find()->where(['student_id' => $student->user_id])->all();
                foreach($parents as $key => $parent) :
                    $users['parents'][] = $parent->user_id;
                endforeach;
            endforeach;
        endforeach;
        $teachers = Teachers::className()::find()->where(['school_id' => $id])->all();
        foreach($teachers as $key => $teacher) :
            $users['teachers'][] = $teacher->user_id;
        endforeach;
        $director = Directors::className()::findOne(['school_id' => $id]);
        $users['director'] = $director->user_id;

        return $users;
    }

    public function getCountOfAllStudentsBySchool($id)
    {
        $students_count = 0;
        $students_count_by_classes = [];

        $classes = Classes::className()::find()->where(['school_id' => $id])->all();
        foreach($classes as $key => $class) :
            $students_count_by_classes[] = Students::className()::find()->where(['class_id' => $class->id])->count();
        endforeach;
        foreach($students_count_by_classes as $count) :
            $students_count += $count;
        endforeach;

        return $students_count;
    }

    public function removeSchool($id)
    {
        $users = self::getAllUsersBySchool($id);
        CallsSchedule::className()::deleteAll(['school_id' => $id]); // remove Calls Schedule of school;
        if (InfoAboutSchool::className()::findOne(['school_id' => $id]))
        {
            InfoAboutSchool::className()::findOne(['school_id' => $id])->delete();
        }
        SchoolStaff::className()::deleteAll(['school_id' => $id]);
        Subjects::className()::deleteAll(['school_id' => $id]);
        if (Directors::className()::findOne(['school_id' => $id]))
        {
            Directors::className()::findOne(['school_id' => $id])->delete();
        }
        $classes = Classes::className()::find()->where(['school_id' => $id])->all();
        foreach($classes as $key => $class) :
            ClassLessonsSchedule::className()::deleteAll(['class_id' => $class->id]);
            ClassSubjects::className()::deleteAll(['class_id' => $class->id]);
            ClassTeachersAccess::className()::deleteAll(['class_id' => $class->id]);
            ClassTeachersSubjectsAccess::className()::deleteAll(['class_id' => $class->id]);
            Marks::className()::deleteAll(['class_id' => $class->id]);
            Students::className()::deleteAll(['class_id' => $class->id]);
        endforeach;
        Classes::className()::deleteAll(['school_id' => $id]);
        Teachers::className()::deleteAll(['school_id' => $id]);
        if ($users['parents']) :
            foreach($users['parents'] as $key => $user_id) :
                Change_password::className()::deleteAll(['id' => $user_id]);
                if (Parents::className()::findOne(['user_id' => $user_id]))
                {
                    Parents::className()::findOne(['user_id' => $user_id])->delete();
                }
                $questions = Questions::className()::find()->where(['user_id' => $user_id])->all();
                foreach($questions as $key => $question) :
                    Support::className()::deleteAll(['question_id' => $question->id]);
                endforeach;
                Questions::className()::deleteAll(['user_id' => $user_id]);
                if (Telegram::className()::findOne(['user_id' => $user_id]))
                {
                    Telegram::className()::findOne(['user_id' => $user_id])->delete();
                }
                CronTabsBirthdays::className()::deleteAll(['user_id' => $user_id]);
                CronTabsNextPayment::className()::deleteAll(['user_id' => $user_id]);
            endforeach;
        endif;
        if ($users['students']) :
            foreach($users['students'] as $key => $user_id) :
                Change_password::className()::deleteAll(['id' => $user_id]);
                $questions = Questions::className()::find()->where(['user_id' => $user_id])->all();
                foreach($questions as $key => $question) :
                    Support::className()::deleteAll(['question_id' => $question->id]);
                endforeach;
                Questions::className()::deleteAll(['user_id' => $user_id]);
                if (Telegram::className()::findOne(['user_id' => $user_id]))
                {
                    Telegram::className()::findOne(['user_id' => $user_id])->delete();
                }
                CronTabsBirthdays::className()::deleteAll(['user_id' => $user_id]);
                CronTabsNextPayment::className()::deleteAll(['user_id' => $user_id]);
            endforeach;
        endif;
        if ($users['teachers']) :
            foreach($users['teachers'] as $key => $user_id) :
                Change_password::className()::deleteAll(['id' => $user_id]);
                $questions = Questions::className()::find()->where(['user_id' => $user_id])->all();
                foreach($questions as $key => $question) :
                    Support::className()::deleteAll(['question_id' => $question->id]);
                endforeach;
                Questions::className()::deleteAll(['user_id' => $user_id]);
                if (Telegram::className()::findOne(['user_id' => $user_id]))
                {
                    Telegram::className()::findOne(['user_id' => $user_id])->delete();
                }
                CronTabsBirthdays::className()::deleteAll(['user_id' => $user_id]);
                CronTabsNextPayment::className()::deleteAll(['user_id' => $user_id]);
            endforeach;
        endif;
        if ($users['director']) :
            Change_password::className()::deleteAll(['id' => $users['director']]);
            $questions = Questions::className()::find()->where(['user_id' => $users['director']])->all();
            foreach($questions as $key => $question) :
                Support::className()::deleteAll(['question_id' => $question->id]);
            endforeach;
            Questions::className()::deleteAll(['user_id' => $users['director']]);
            if (Telegram::className()::findOne(['user_id' => $users['director']]))
            {
                Telegram::className()::findOne(['user_id' => $users['director']])->delete();
            }
            CronTabsBirthdays::className()::deleteAll(['user_id' => $users['director']]);
            CronTabsNextPayment::className()::deleteAll(['user_id' => $users['director']]);
        endif;
        foreach($users as $key => $value) :
            foreach($value as $k => $v) :
                $user = User::findOne($v);
                if ($user->image != '/images/_no_user.png') {
                    unlink(Yii::$app->basePath . '/web' . $user->image);
                }
                $user->delete();
            endforeach;
        endforeach;
        self::findOne($id)->delete();

        return true;
    }
}