<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type_message
 * @property string $message
 * @property string $date
 */
class Questions extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'message'], 'required'],
            [['user_id'], 'integer'],
            [['type_message', 'message'], 'string'],
            [['date'], 'string', 'max' => 250],
            ['count_answers', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID користувача',
            'user_name' => 'Користувач',
            'message' => 'Текст',
            'type_message' => 'Тема листа',
            'custom_type' => 'Тема листа',
            'custom_status' => 'Статус',
            'date' => 'Дата',
            'count_answers' => 'Кількість відповідей',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCyrillic_type()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'type_message']);
    }

    public function getCustom_type()
    {
        return $this->cyrillic_type->cyrillic_name;
    }

    public function getCyrillic_status()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'status']);
    }

    public function getCustom_status()
    {
        return $this->cyrillic_status->cyrillic_name;
    }

    public function getUser_name()
    {
        return $this->user->name;
    }

    public function getCount_answers()
    {
        $answers = $this->hasMany(Support::className(), ['question_id' => 'id']);
        return $answers->count();
    }

}
