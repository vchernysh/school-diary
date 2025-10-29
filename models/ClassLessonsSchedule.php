<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_lessons_schedule".
 *
 * @property int $id
 * @property int $class_id
 * @property string $day
 * @property int $lesson_number
 * @property int $subject_id
 */
class ClassLessonsSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_lessons_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'day', 'lesson_number'], 'required'],
            [['subject_id'], 'required', 'message' => 'Необхідно вибрати "Предмет".'],
            [['class_id', 'lesson_number', 'subject_id'], 'integer'],
            [['day'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Клас',
            'day' => 'День тижня',
            'lesson_number' => '№ уроку',
            'subject_id' => 'Предмет',
        ];
    }
}
