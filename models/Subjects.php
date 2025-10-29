<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property int $id
 * @property int $school_id
 * @property string $subject_name
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['school_id', 'subject_name'], 'required'],
            [['school_id'], 'integer'],
            [['subject_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_id' => 'Школа',
            'subject_name' => 'Назва предмету',
        ];
    }

    public function getClassSubjectsByTeacherAccess($class_id, $teacher_id)
    {

        return Subjects::find()
            ->select(['subjects.id', 'subjects.subject_name'])
            ->innerJoin('class_teachers_subjects_access', 'subjects.id = class_teachers_subjects_access.subject_id')
            ->where(['class_teachers_subjects_access.class_id' => $class_id, 'class_teachers_subjects_access.teacher_id' => $teacher_id])
            ->all();
    }

    public function getClassesWithCurrentSubject()
    {
        // return $this->hasMany(Classes::className(), ['id' => 'class_id'])
        //     ->viaTable('class_subjects', ['subject_id' => 'id'], function($query) {
        //         $query->andWhere(['subject_id' => $this->id]);
        //     });

        return $this->hasMany(ClassSubjects::className(), ['subject_id' => 'id']);
        
    }
}
