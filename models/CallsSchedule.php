<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calls_schedule".
 *
 * @property int $id
 * @property int $school_id
 * @property int $lesson_number
 * @property string $start
 * @property string $end
 * @property string $break
 */
class CallsSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calls_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['school_id', 'lesson_number', 'start', 'end'], 'required'],
            [['school_id', 'lesson_number'], 'integer'],
            [['start', 'end', 'break'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_id' => 'School ID',
            'lesson_number' => '№ уроку',
            'start' => 'Початок уроку',
            'end' => 'Кінець уроку',
            'break' => 'Перерва',
        ];
    }
}
