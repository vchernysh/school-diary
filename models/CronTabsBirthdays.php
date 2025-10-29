<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "__cron_tabs_birthdays".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type_of_record
 */
class CronTabsBirthdays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '__cron_tabs_birthdays';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type_of_record', 'birthday'], 'required'],
            [['user_id', 'birthday'], 'integer'],
            [['type_of_record'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'type_of_record' => 'Type Of Record',
            'birthday' => 'Birthday',
        ];
    }
}
