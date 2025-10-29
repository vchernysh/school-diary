<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "class_teachers_access".
 *
 * @property int $id
 * @property int $class_id
 * @property int $teacher_id
 */
class ClassTeachersAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_teachers_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'teacher_id'], 'required'],
            [['class_id', 'teacher_id'], 'integer'],
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
            'teacher_id' => 'Teacher ID',
        ];
    }

    public function getClassesByTeachersAccess($id)
    {
        $sql = '
            SELECT * FROM `classes`
                INNER JOIN `class_teachers_access`
                    ON `classes`.`id` = `class_teachers_access`.`class_id`
            WHERE `class_teachers_access`.`teacher_id` = ' . $id . '
            ORDER BY `classes`.`name`
        ';

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function getSubjects($class_id, $teacher_id)
    {
        $sql = '
            SELECT `subjects`.`id`, `subjects`.`subject_name` FROM `subjects`
                INNER JOIN `class_teachers_subjects_access`
                    ON `class_teachers_subjects_access`.`subject_id` = `subjects`.`id`
                WHERE `class_teachers_subjects_access`.`teacher_id` = ' . $teacher_id . '
                AND `class_teachers_subjects_access`.`class_id` = ' . $class_id . '
        ';
        
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}
