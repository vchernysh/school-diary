<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property int $user_id
 * @property int $class_id
 */
class Students extends \yii\db\ActiveRecord
{

    public $new_email, $new_username, $new_name, $birthday_string, $birthday, $new_phone, $parents_of_student, $new_fio;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['user_id', 'new_email', 'new_username', 'new_name', 'new_fio'], 'required'],
            ['class_id', 'required', 'message' => 'Необхідно вибрати "Клас".'],
            ['new_username', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'username', 'when' => function ($query) {
                return $query->username != $this->new_username;
            }],
            ['new_email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email', 'when' => function ($query) {
                return $query->email != $this->new_email;
            }],
            [['new_username'], 'match', 'pattern' => '/^[-_a-zA-Z0-9]+$/', 'message' => 'Логін має містити лише літери латиниці або цифри і знаки \' - \' та \' _ \''],
            [['new_email'], 'email'],
            [['new_username', 'new_name', 'new_email', 'new_fio'], 'string', 'max' => 300],
            [['birthday_string', 'new_phone'], 'string'],
            [['user_id'], 'unique'],
            ['birthday', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {

        return [
            'user_id' => 'ID',
            'username' => 'Логін',
            'new_username' => 'Логін',
            'email' => 'Email',
            'new_email' => 'Email',
            'name' => 'Ім\'я',
            'new_name' => 'Ім\'я',
            'new_fio' => 'П.І.Б.',
            'fio' => 'П.І.Б.',
            'school_id' => 'Школа',
            'birthday' => 'День народження',
            'birthday_string' => 'День народження',
            'custom_type' => 'Тип користувача',
            'class_id' => 'Клас',
            'new_phone' => 'Телефон',
            'class_name' => 'Клас',
            'parents_of_student' => 'Батьки учня',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'class_id']);
    }

    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'school_id'])
            ->via('class');
    }

    public function getName()
    {
        return $this->user->name;
    }

    public function getUsername()
    {
        return $this->user->username;
    }
    
    public function getEmail()
    {
        return $this->user->email;
    }

    public function getFio()
    {
        return $this->user->fio;
    }

    public function getPhone()
    {
        return $this->user->phone;
    }

    public function getClass_name()
    {
        return $this->class->name;
    }

    public function getStudentsByClass($class_id)
    {

        $sql = "
            SELECT `user`.`id`, `user`.`name` FROM `user`
                INNER JOIN `students`
                    ON `user`.`id` = `students`.`user_id`
            WHERE `students`.`class_id` = '" . $class_id . "'
            ORDER BY CONVERT(`user`.`name` USING utf8) COLLATE utf8_unicode_ci
        ";

        $students_list = Yii::$app->db->createCommand($sql)->queryAll();

        $students = [];
        
        if ($students_list) {
            foreach($students_list as $key => $value) :
                $students[$value['id']] = $value['name'];
            endforeach;
        }

        return $students;
    }

}
