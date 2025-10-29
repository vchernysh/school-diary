<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "__cron_tabs_next_payment".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type_of_record
 */
class CronTabsNextPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '__cron_tabs_next_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type_of_record', 'time'], 'required'],
            [['user_id', 'time'], 'integer'],
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
            'time' => 'Unixtimestamp Date',
        ];
    }
}
