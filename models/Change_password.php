<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;

class Change_password extends ActiveRecord
{

    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['email' => 'email']);
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
        ];
    }

    public static function tableName()
    {

        return 'change_password';

        // END public static function tableName();
    }

}
