<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;

class Teachers extends ActiveRecord
{
    public $new_email, $new_username, $new_name, $birthday_string, $birthday, $new_phone, $new_fio;

    public static function tableName()
    {

        return 'teachers';

        // END public static function tableName();
    }

    public function rules()
    {
        return [
            [['user_id', 'subject', 'new_email', 'new_username', 'new_name', 'new_fio'], 'required'],
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
            ['birthday', 'integer'],
        ];
    }

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
            'fio' => 'П.І.Б.',
            'new_fio' => 'П.І.Б.',
            'subject' => 'Предмет',
            'school_id' => 'Школа',
            'birthday' => 'День народження',
            'birthday_string' => 'День народження',
            'custom_type' => 'Тип користувача',
            'new_phone' => 'Телефон',
        ];
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'school_id']);
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

    public function getPhone()
    {
        return $this->user->phone;
    }
    public function getFio()
    {
        return $this->user->fio;
    }

}
