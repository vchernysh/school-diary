<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;

class Telegram extends ActiveRecord
{

    public static function tableName()
    {

        return 'telegram';

        // END public static function tableName();
    }

    public function rules()
    {
        return [
            ['telegram_chat_id', 'required'],
            ['user_id', 'required', 'message' => 'Необхідно вибрати "Користувача".'],
        ];
    }

    public function attributeLabels()
    {
    	return [
    		'user_id' => 'ID',
    		'telegram_chat_id' => 'Telegram Chat ID',
            'name' => 'Користувач',
            'email' => 'Email',
            'username' => 'Логін',
            'custom_status' => 'Статус',
    	];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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

    public function getUsers()
    {
        return User::className()::find()
            ->leftJoin('telegram', 'user.id = telegram.user_id')
            ->select(['id', 'name', 'username'])
            ->where(['is', 'telegram.user_id', null])
            ->all();    
    }

    public function getCyrillic_status()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'status']);
    }

    public function getCustom_status()
    {
        return $this->cyrillic_status->cyrillic_name;
    }

}
