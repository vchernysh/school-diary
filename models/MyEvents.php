<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "______my_events".
 *
 * @property int $id
 * @property int $time
 * @property string $event
 */
class MyEvents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '______my_events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'event'], 'required'],
            [['time'], 'integer'],
            [['event'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'event' => 'Event',
        ];
    }
}
