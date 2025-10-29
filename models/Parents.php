<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parents".
 *
 * @property int $user_id
 * @property int $student_id
 * @property string $type
 */
class Parents extends \yii\db\ActiveRecord
{

    public $new_email, $new_username, $new_name, $child_fio, $new_fio, $telegram_id, $birthday_string, $birthday, $new_phone, $divider_parent;
    public $divider_child, $child_id, $child_username, $child_image, $child_birthday, $child_class, $child_teacher, $child_director, $child_type, $child_telegram_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'new_email', 'new_username', 'new_name', 'new_fio'], 'required'],
            ['type', 'required', 'message' => 'Необхідно вибрати "Тип користувача".'],
            ['student_id', 'required', 'message' => 'Необхідно вибрати "Учня".'],
            ['new_username', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'username', 'when' => function ($query) {
                return $query->username != $this->new_username;
            }],
            ['new_email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email', 'when' => function ($query) {
                return $query->email != $this->new_email;
            }],
            [['new_username'], 'match', 'pattern' => '/^[-_a-zA-Z0-9]+$/', 'message' => 'Логін має містити лише літери латиниці або цифри і знаки \' - \' та \' _ \''],
            [['new_email'], 'email'],
            [['new_username', 'new_name', 'new_email', 'new_fio'], 'string', 'max' => 300],
            [['birthday_string', 'new_phone', 'type'], 'string'],
            ['birthday', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Учень',
            'type' => 'Тип користувача',
            'divider_child' => 'Інформація про учня',
            'divider_parent' => 'Інформація про члена родини',
            'username' => 'Логін',
            'new_username' => 'Логін',
            'email' => 'Email',
            'new_email' => 'Email',
            'name' => 'Ім\'я члена родини',
            'new_name' => 'Ім\'я члена родини',
            'new_fio' => 'П.І.Б. члена родини',
            'fio' => 'П.І.Б. члена родини',
            'telegram_id' => 'Telegram ID',
            'birthday' => 'День народження',
            'birthday_string' => 'День народження',
            'custom_type' => 'Тип користувача',
            'new_phone' => 'Телефон',
            'child_name' => 'Ім\'я учня',
            'child_fio' => 'П.І.Б. учня',
            'phone' => 'Телефон',
            'child_phone' => 'Телефон учня',
            'child_email' => 'Email учня',
            'child_id' => 'ID учня',
            'child_username' => 'Логін учня',
            'child_image' => '',
            'child_birthday' => 'День народження учня',
            'child_class' => 'Клас',
            'child_teacher' => 'Класний керівник',
            'child_director' => 'Директор',
            'child_type' => 'Тип користувача учня',
            'child_telegram_id' => 'Telegram ID учня',
            'user_id' => 'ID члена родини',
            'class_name' => 'Клас',
        ];
    }

    public function getCyrillic_type()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'type']);
    }

    public function getCustom_type()
    {
        return $this->cyrillic_type->cyrillic_name;
    }

    public function getChild()
    {
        return $this->hasOne(Students::className(), ['user_id' => 'student_id']);
    }

    public function getChild_user()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->via('child');
    }

    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['id' => 'class_id'])
            ->via('child');
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['user_id' => 'class_teacher_id'])
            ->via('class');
    }

    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'school_id'])
            ->via('class');
    }

    public function getDirector()
    {
        return $this->hasOne(Directors::className(), ['school_id' => 'id'])
            ->via('school');
    }

    public function getDirector_name()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->via('director');
    }

    public function getClass_teacher()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->via('teacher');
    }

    public function getChild_name()
    {
        return $this->child->name;
    }

    public function getChild_fio()
    {
        return $this->child->fio;
    }
    
    public function getChild_email()
    {
        return $this->child->email;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getName()
    {
        return $this->user->name;
    }

    public function getFio()
    {
        return $this->user->fio;
    }

    public function getEmail()
    {
        return $this->user->email;
    }

    public function getUsername()
    {
        return $this->user->username;
    }

    public function getPhone()
    {
        return $this->user->phone;
    }

}
