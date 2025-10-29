<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "______my_future_cron_tabs".
 *
 * @property int $id
 * @property int $event_id
 * @property string $type_of_record
 * @property string $event_time
 * @property int $time
 */
class MyFutureCronTabs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '______my_future_cron_tabs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'type_of_record', 'event_time', 'time'], 'required'],
            [['event_id', 'time'], 'integer'],
            [['type_of_record'], 'string'],
            [['event_time'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'type_of_record' => 'Type Of Record',
            'event_time' => 'Event Time',
            'time' => 'Time',
        ];
    }
}
