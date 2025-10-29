<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_subjects".
 *
 * @property int $class_id
 * @property int $subject_id
 */
class ClassSubjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_subjects';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'subject_id'], 'required'],
            [['class_id', 'subject_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'class_id' => 'Class ID',
            'subject_id' => 'Subject ID',
        ];
    }
}
