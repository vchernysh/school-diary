<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "support".
 *
 * @property int $id
 * @property int $question_id
 * @property string $type_answer
 * @property string $message
 * @property string $date
 */
class Support extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'message'], 'required'],
            [['question_id', 'date'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'ID питання',
            'type_answer' => 'Тип користувача',
            'message' => 'Повідомлення',
            'date' => 'Дата',
        ];
    }

    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    public function getCyrillic_user()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'type_answer']);
    }

    public function getAnswer_type()
    {
        return $this->cyrillic_user->cyrillic_name;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->via('questions');
    }
}
