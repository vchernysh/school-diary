<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;
    use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    public $telegram_chat_id, $img, $birthday_string, $user_region, $user_city, $user_school, $user_class, $user_director, $user_class_teacher, $user_subject;

    public static function getDb()
    {

        return Yii::$app->get('db');

        // END public static function getDb();
    }

    public static function tableName()
    {

        return 'user';

        // END public static function tableName();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        // return static::findOne(['access_token' => $token]);


                // !!! It doesn't need but it must be called; !!!
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        
        return static::findOne(['username' => $username]);

    }


    public static function findByEmail($email)
    {
        
        return static::findOne(['email' => $email]);

    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === $password;

        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public function generateAuthKey()
    {

        $this->auth_key = Yii::$app->security->generateRandomString();

    }


    public function rules()
    {
        return [
            [['email', 'username', 'name', 'fio', 'type'], 'required'],
            ['email', 'unique'],
            ['username', 'unique'],
            ['username', 'match', 'pattern' => '/^[-_a-zA-Z0-9]+$/', 'message' => 'Логін має містити лише літери латиниці або цифри і знаки \' - \' та \' _ \''],
            ['email', 'email'],
            [['img'], 'file', 'maxSize' => 1024 * 1024 * 2],
            ['phone', 'string', 'max' => 30],
            [['username', 'name', 'email'], 'string', 'max' => 300],
            ['birthday_string', 'string'],
            [['birthday', 'send_mail'], 'integer'],
            [['custom_type'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логін',
            'email' => 'Email',
            'name' => 'Ім\'я',
            'fio' => 'П.І.Б.',
            'phone' => 'Телефон',
            'image' => 'Зображення',
            'img' => 'Зображення',
            'send_mail' => 'Надсилати повідомлення на вашу пошту від технічної підтримки?',
            'birthday' => 'День народження',
            'birthday_string' => 'День народження',
            'type' => 'Тип користувача',
            'custom_type' => 'Тип користувача',
            'user_region' => 'Область',
            'user_city' => 'Місто',
            'user_school' => 'Школа',
            'user_class' => 'Клас',
            'user_director' => 'Директор',
            'user_class_teacher' => 'Класний керівник',
            'user_subject' => 'Профільний предмет'
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {
            $this->img->saveAs('uploads/users/' . $id . '.' . $this->img->extension);
            return true;
        } else {
            return false;
        }
    }

    /*
    *
    *
    *
    */


    
    public function getDirectors()
    {
        return $this->hasOne(Directors::className(), ['user_id' => 'id']);
    }

    public function getClassTeacher()
    {
        if ($this->type == 'student')
        {
            return User::findOne(['id' => $this->student_class->class_teacher_id]);
        } elseif ($this->type == 'parent') {
            return User::findOne(['id' => $this->children->class->class_teacher_id]);
        }
    }

    public function getRegions()
    {
        return Regions::className()::find()->all();
    }

    public function getCities()
    {
        return Cities::className()::find()->all();
    }

    public function getTelegram()
    {
        return $this->hasOne(Telegram::className(), ['user_id' => 'id']);
    }

    public function getSchool()
    {

    	if ($this->type == 'admin') {
        	return $this->hasOne(Schools::className(), ['id' => 'school_id'])
                ->viaTable('admins', ['user_id' => 'id'], function ($query) {
                    $query->andWhere(['user_id' => $this->id]);
                });

		} elseif ($this->type == 'director') {

            return $this->hasOne(Schools::className(), ['id' => 'school_id'])
                ->viaTable('directors', ['user_id' => 'id'], function ($query) {
                    $query->andWhere(['user_id' => $this->id]);
                });

        } elseif ($this->type == 'teacher') {

        	return $this->hasOne(Schools::className(), ['id' => 'school_id'])
                ->viaTable('teachers', ['user_id' => 'id'], function ($query) {
                    $query->andWhere(['user_id' => $this->id]);
                });
		} elseif ($this->type == 'student') {
            
            return $this->hasOne(Schools::className(), ['id' => 'school_id'])
                ->via('student_class');

        } elseif ($this->type == 'parent') {

            return $this->hasOne(Schools::className(), ['id' => 'school_id'])
                ->via('childrenClass');
        }
    }


    public function getAllUsersBySchool($user_id, $user_type)
    {

        $students = [];
        $director = [];
        $teachers = [];
        $parents = [];
        $result = [];

        if ($user_type == 'student')
        {

            $class_id = User::findOne($user_id)->student_class->id;
            $students_list = Students::find()->where(['class_id' => $class_id])->andWhere(['!=', 'user_id', $user_id])->all();

            foreach($students_list as $key => $value) :
                $students[] = $value->user_id;
            endforeach;

            $teachers[] = Classes::findOne(['id' => $class_id])->class_teacher_id;

            $parents_sql = "SELECT `parents`.`user_id` FROM `parents`
                INNER JOIN `students`
                    ON `parents`.`student_id` = `students`.`user_id`
                INNER JOIN `classes`
                    ON `classes`.`id` = `students`.`class_id`
                WHERE `classes`.`id` = '" . $class_id . "'";

            $parents_list = Yii::$app->db->createCommand($parents_sql)->queryAll();

            foreach($parents_list as $key => $value) :
                $parents[] = $value['user_id'];
            endforeach;

            $result['students'] = $students;
            $result['director'] = $director;
            $result['teachers'] = $teachers;
            $result['parents'] = $parents;

        } elseif ($user_type == 'teacher') {

            $class_id = User::findOne($user_id)->class->id;
            $school_id = User::findOne($user_id)->school->id;

            $students_list = Students::find()->where(['class_id' => $class_id])->all();

            foreach($students_list as $key => $value) :
                $students[] = $value->user_id;
            endforeach;

            $parents_sql = "SELECT `parents`.`user_id` FROM `parents`
                INNER JOIN `students`
                    ON `parents`.`student_id` = `students`.`user_id`
                INNER JOIN `classes`
                    ON `classes`.`id` = `students`.`class_id`
                WHERE `classes`.`id` = '" . $class_id . "'";

            $parents_list = Yii::$app->db->createCommand($parents_sql)->queryAll();

            foreach($parents_list as $key => $value) :
                $parents[] = $value['user_id'];
            endforeach;

            $director_id = Directors::findOne(['school_id' => $school_id])->user_id;
            $director[] = $director_id;

            $teachers_list = Teachers::find()->where(['school_id' => $school_id])->andWhere(['!=', 'user_id', $director_id])->andWhere(['!=', 'user_id', $user_id])->all();

            foreach($teachers_list as $key => $value) :
                $teachers[] = $value['user_id'];
            endforeach;

            $result['students'] = $students;
            $result['director'] = $director;
            $result['teachers'] = $teachers;
            $result['parents'] = $parents;

        } elseif ($user_type == 'director') {
            
            $school_id = User::findOne($user_id)->school->id;

            $teachers_list = Teachers::find()->where(['school_id' => $school_id])->andWhere(['!=', 'user_id', $user_id])->all();

            foreach($teachers_list as $key => $value) :
                $teachers[] = $value['user_id'];
            endforeach;

            $parents_sql = "SELECT `parents`.`user_id` FROM `parents`
                INNER JOIN `students`
                    ON `parents`.`student_id` = `students`.`user_id`
                INNER JOIN `classes`
                    ON `classes`.`id` = `students`.`class_id`
                WHERE `classes`.`school_id` = '" . $school_id . "'";

            $parents_list = Yii::$app->db->createCommand($parents_sql)->queryAll();

            foreach($parents_list as $key => $value) :
                $parents[] = $value['user_id'];
            endforeach;

            $students_sql = "SELECT `students`.`user_id` FROM `students`
                INNER JOIN `classes`
                    ON `classes`.`id` = `students`.`class_id`
                WHERE `classes`.`school_id` = '" . $school_id . "'";

            $students_list = Yii::$app->db->createCommand($students_sql)->queryAll();

            foreach($students_list as $key => $value) :
                $students[] = $value['user_id'];
            endforeach;

            $result['students'] = $students;
            $result['director'] = $director;
            $result['teachers'] = $teachers;
            $result['parents'] = $parents;

        }

        return $result;
    }

    public function getParentsTelegramIDs($id)
    {

        $sql = "SELECT `telegram_chat_id` FROM `telegram`
                    INNER JOIN `parents`
                        ON `parents`.`user_id` = `telegram`.`user_id`
                    WHERE `parents`.`student_id` = '" . $id . "'";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function getParent()
    {
        return $this->hasOne(Parents::className(), ['user_id' => 'id']);
    }

    public function getChildren()
    {
        return $this->hasOne(Students::className(), ['user_id' => 'student_id'])
            ->via('parent');
    }
    
    public function getChildrenClass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'class_id'])
            ->via('children');
    }

    public function getStudent_class()
    {   
        return $this->hasOne(Classes::className(), ['id' => 'class_id'])
            ->viaTable('students', ['user_id' => 'id'], function ($query) {
                $query->andWhere(['user_id' => $this->id]);
            });
    }

    public function getDirector_id()
    {
        return $this->hasOne(Directors::className(), ['school_id' => 'id'])
        	->via('school');
    }

    public function getDirector()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
        	->via('director_id');
    }

    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['class_teacher_id' => 'id']);
    }

    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id'])
            ->via('school');
    }

    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id'])
            ->via('city');
    }

    public function getSubject()
    {
        return $this->hasOne(Teachers::className(), ['user_id' => 'id']);
    }

    public function getCyrillic_type()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'type']);
    }

    public function getCustom_type()
    {
        return $this->cyrillic_type->cyrillic_name;
    }

    public function getPaymentForAllSchool($school_id)
    {

        $sql = "SELECT * FROM `a_payments_for_all_school`
                    INNER JOIN 
                        (SELECT MAX(`unix_date_to`) as `max_date`
                        FROM `a_payments_for_all_school`
                        WHERE `school_id` = " . $school_id . "
                        ) AS `p`
                    ON `a_payments_for_all_school`.`unix_date_to` = `p`.`max_date`";

        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    public function getPaymentOfUser()
    {

        $sql = '';

        if ($this->type == 'student')
        {
            $sql = "SELECT * FROM `a_payments`
                        INNER JOIN 
                            (SELECT MAX(`unix_date_to`) as `max_date`
                            FROM `a_payments`
                            WHERE `student_id` = " . $this->id . "
                            ) AS `p`
                        ON `a_payments`.`unix_date_to` = `p`.`max_date`";

            return Yii::$app->db->createCommand($sql)->queryOne();
        
        } elseif ($this->type == 'parent') {

            $sql = "SELECT * FROM `a_payments`
                        INNER JOIN 
                            (SELECT MAX(`unix_date_to`) as `max_date`
                            FROM `a_payments`
                            WHERE `student_id` = " . $this->children->user_id . "
                            ) AS `p`
                        ON `a_payments`.`unix_date_to` = `p`.`max_date`";

            return Yii::$app->db->createCommand($sql)->queryOne();
        }

    }

    public function getStudentIDViaPayment()
    {
        if ($this->type == 'student')
        {
            return $this->id;
        } elseif ($this->type == 'parent') {
            return $this->children->user_id;
        }
    
    }


    public function removeUser($id)
    {
        $user = User::findOne($id);

        if ($user->image != '/images/_no_user.png') {
            unlink(Yii::$app->basePath . '/web' . $user->image);
        }
        if ($user->type == 'director')
        {
            if (Directors::className()::findOne(['user_id' => $id]))
            {
                Directors::className()::findOne(['user_id' => $id])->delete();
            }
            ClassTeachersAccess::className()::deleteAll(['teacher_id' => $id]);
            ClassTeachersSubjectsAccess::className()::deleteAll(['teacher_id' => $id]);
            if (Teachers::className()::findOne(['user_id' => $id]))
            {
                Teachers::className()::findOne(['user_id' => $id])->delete();
            }
        } elseif ($user->type == 'parent')
        {
            if (Parents::className()::findOne(['user_id' => $id]))
            {
                Parents::className()::findOne(['user_id' => $id])->delete();
            }
        } elseif ($user->type == 'student')
        {
            Marks::className()::deleteAll(['student_id' => $id]);
            $parents = Parents::find()->where(['student_id' => $id])->all();
            if ($parents) {
                foreach($parents as $parent) {
                    $parent_user = User::findOne(['id' => $parent->user_id]);
                    if ($parent_user) {
                        if ($parent_user->image != '/images/_no_user.png') {
                            unlink(Yii::$app->basePath . '/web' . $parent_user->image);
                        }
                        if (Telegram::className()::findOne(['user_id' => $parent->user_id]))
                        {
                            Telegram::className()::findOne(['user_id' => $parent->user_id])->delete();
                        }
                        CronTabsBirthdays::className()::deleteAll(['user_id' => $parent->user_id]);
                        CronTabsNextPayment::className()::deleteAll(['user_id' => $parent->user_id]);
                        Change_password::className()::deleteAll(['id' => $parent->user_id]);
                        $questions = Questions::className()::find()->where(['user_id' => $parent->user_id])->all();
                        foreach($questions as $key => $question) :
                            Support::className()::deleteAll(['question_id' => $question->id]);
                        endforeach;
                        Questions::className()::deleteAll(['user_id' => $parent->user_id]);
                        $parent_user->delete();
                    }
                }
                Parents::className()::deleteAll(['student_id' => $id]);
            }
            if (Students::className()::findOne(['user_id' => $id]))
            {
                Students::className()::findOne(['user_id' => $id])->delete();
            }
        } elseif ($user->type == 'teacher')
        {
            ClassTeachersAccess::className()::deleteAll(['teacher_id' => $id]);
            ClassTeachersSubjectsAccess::className()::deleteAll(['teacher_id' => $id]);
            if (Teachers::className()::findOne(['user_id' => $id]))
            {
                Teachers::className()::findOne(['user_id' => $id])->delete();
            }
        }

        if (Telegram::className()::findOne(['user_id' => $id]))
        {
            Telegram::className()::findOne(['user_id' => $id])->delete();
        }
        CronTabsBirthdays::className()::deleteAll(['user_id' => $id]);
        CronTabsNextPayment::className()::deleteAll(['user_id' => $id]);
        Change_password::className()::deleteAll(['id' => $id]);
        $questions = Questions::className()::find()->where(['user_id' => $id])->all();
        foreach($questions as $key => $question) :
            Support::className()::deleteAll(['question_id' => $question->id]);
        endforeach;
        Questions::className()::deleteAll(['user_id' => $id]);

        self::findOne($id)->delete();

        return true;
    }

}