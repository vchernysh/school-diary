<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;
    use app\models\{Teachers, User, Students};

class Classes extends ActiveRecord
{

    public $teacher_id, $subjects, $teachers, $teachers_subjects, $schedule;

    public static function tableName()
    {

        return 'classes';

        // END public static function tableName();
    }

    public function rules()
    {
        return [
            [['teacher_name', 'name'], 'required'],
            ['teacher_id', 'required', 'message' => 'Необхідно вибрати "Класного керівника".'],
            [['count_of_students'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
    	return [
    		'id' => 'ID',
    		'name' => 'Назва',
            'teacher_id' => 'Класний керівник',
    		'teacher_name' => 'Класний Керівник',
    		'count_of_students' => 'Кількість учнів',
            'subjects' => 'Список предметів класу',
            'teachers' => 'Список вчителів, які можуть виставляти оцінки класу',
            'schedule' => 'Розклад',
            'list_of_students' => 'Список учнів',
    	];
    }

	public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'class_teacher_id']);
    }

    public function getClass_teachers()
    {
        return Teachers::className()::find()
            ->select(['teachers.user_id', 'user.name', 'teachers.subject'])
            ->leftJoin('classes', 'teachers.user_id = classes.class_teacher_id')
            ->innerJoin('user', 'teachers.user_id = user.id')
            ->where(['is', 'classes.class_teacher_id', null])
            ->andWhere(['teachers.school_id' => Yii::$app->user->identity->school->id])
            ->asArray()
            ->all();
    }

    public function getSubject()
    {
        return $this->hasOne(Teachers::className(), ['user_id' => 'class_teacher_id']);
    }

    public function getTeacher_name()
    {
        return $this->teacher->name;
    }

    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['class_id' => 'id'])->count();
    }

    public function getCount_of_students()
    {
        return $this->students;
    }

    public function getSchoolSubjects()
    {
        $sql = '
            SELECT * FROM `subjects`
            WHERE NOT EXISTS
                (
                    SELECT NULL FROM `class_subjects`
                    WHERE `class_subjects`.`subject_id` = `subjects`.`id`
                    AND `class_subjects`.`class_id` = ' . $this->id . '
                )
            AND `subjects`.`school_id` = ' . $this->school_id . '
        ';
        return Yii::$app->db->createCommand($sql)->queryAll();
            
    }

    public function getAllSchoolSubjects()
    {
        $sql = '
            SELECT * FROM `subjects`
            WHERE `subjects`.`school_id` = ' . $this->school_id . '
        ';
        return Yii::$app->db->createCommand($sql)->queryAll();
            
    }

    public function getClassSubjects()
    {
        return $this->hasMany(Subjects::className(), ['id' => 'subject_id'])
            ->viaTable('class_subjects', ['class_id' => 'id'], function ($query) {
                $query->andWhere(['class_id' => $this->id]);
            });
    }

    public function getSchoolTeachers()
    {
        $sql = '
            SELECT `user`.`id`, `user`.`name`, `teachers`.`subject` FROM `user`
                INNER JOIN `teachers`
                    ON `teachers`.`user_id` = `user`.`id`
                    WHERE NOT EXISTS
                        (
                            SELECT NULL FROM `class_teachers_access`
                            WHERE `class_teachers_access`.`teacher_id` = `user`.`id`
                            AND `class_teachers_access`.`class_id` = ' . $this->id . '
                        )
                    AND `teachers`.`user_id` != ' . $this->class_teacher_id . ' 
                    AND `teachers`.`school_id` = ' . $this->school_id . '
        ';
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function getClassTeachersAccess()
    {
        return $this->hasMany(User::className(), ['id' => 'teacher_id'])
            ->viaTable('class_teachers_access', ['class_id' => 'id'], function ($query) {
                $query->andWhere(['class_id' => $this->id])
                    ->andWhere(['!=', 'teacher_id', $this->class_teacher_id]);
            });
    }

    public function getClassSchedule()
    {
        $sql = '
            SELECT `class_lessons_schedule`.`class_id`, `class_lessons_schedule`.`day`, `class_lessons_schedule`.`lesson_number`, `class_lessons_schedule`.`subject_id`, `subjects`.`subject_name` 
            FROM `class_lessons_schedule`
                INNER JOIN `subjects`
                    ON `subjects`.`id` = `class_lessons_schedule`.`subject_id`
            WHERE `class_lessons_schedule`.`class_id` = ' . $this->id . '
            ORDER BY `class_lessons_schedule`.`id`
        ';
        return Yii::$app->db->createCommand($sql)->queryAll();   
    }

    public function getClassScheduleByDay($id, $day)
    {
        $sql = '
            SELECT `class_lessons_schedule`.`class_id`, `class_lessons_schedule`.`day`, `class_lessons_schedule`.`lesson_number`, `class_lessons_schedule`.`subject_id`, `subjects`.`subject_name` 
            FROM `class_lessons_schedule`
                INNER JOIN `subjects`
                    ON `subjects`.`id` = `class_lessons_schedule`.`subject_id`
            WHERE `class_lessons_schedule`.`class_id` = ' . $id . '
            AND `class_lessons_schedule`.`day` = "' . $day . '"
            ORDER BY `class_lessons_schedule`.`id`
        ';
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function getDay($day)
    {
        return ParamsTranslations::findOne(['english_name' => $day])->cyrillic_name;
    }

    public function removeClass(int $id)
    {
        ClassLessonsSchedule::className()::deleteAll(['class_id' => $id]);
        ClassSubjects::className()::deleteAll(['class_id' => $id]);
        ClassTeachersAccess::className()::deleteAll(['class_id' => $id]);
        ClassTeachersSubjectsAccess::className()::deleteAll(['class_id' => $id]);
        Marks::className()::deleteAll(['class_id' => $id]);
        
        $students = Students::className()::find()->where(['class_id' => $id])->all();
        
        foreach($students as $key => $student) :
            User::className()::removeUser($student->user_id);
        endforeach;

        Students::className()::deleteAll(['class_id' => $id]);

        self::findOne($id)->delete();

        return true;
    }

}