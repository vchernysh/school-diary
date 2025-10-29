<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_teachers_subjects_access".
 *
 * @property int $id
 * @property int $class_id
 * @property int $teacher_id
 * @property int $subject_id
 */
class ClassTeachersSubjectsAccess extends \yii\db\ActiveRecord
{
    public $subjects;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_teachers_subjects_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'subject_id'], 'required'],
            ['teacher_id', 'required', 'message' => 'Необхідно вибрати "Вчителя".'],
            [['class_id', 'teacher_id', 'subject_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
            'teacher_id' => 'Класний керівник',
            'subject_id' => 'Subjects ID',
        ];
    }
}
