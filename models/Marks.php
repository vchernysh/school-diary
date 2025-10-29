<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marks".
 *
 * @property int $id
 * @property int $class_id
 * @property int $student_id
 * @property int $subject_id
 * @property string $under_title
 * @property string $mark
 * @property int $date
 */
class Marks extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'student_id', 'subject_id', 'mark', 'date', 'under_title'], 'required'],
            // ['date', 'required', 'message' => 'Необхідно вибрати дату.'],
            // ['under_title', 'required', 'message' => 'Необхідно вибрати тип оцінки.'],
            // ['mark', 'required', 'message' => 'Необхідно вибрати оцінку.'],
            [['class_id', 'student_id', 'subject_id'], 'integer'],
            [['under_title'], 'string'],
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
            'student_id' => 'Student ID',
            'subject_id' => 'Subject ID',
            'under_title' => 'Тип оцінки',
            'mark' => 'Оцінка',
            'date' => 'Дата',
        ];
    }

    public function getMarks($class_id, $subject_id, $date = null, $from = null, $to = null)
    {

        // if (is_null($date)) {

        // } else {
        //     $sql = '
        //         SELECT `marks`.`id`, `marks`.`student_id`, `marks`.`under_title`, `marks`.`mark`, `marks`.`date` FROM `marks`
        //             INNER JOIN `user`
        //                 ON `user`.`id` = `marks`.`student_id`
        //         WHERE `marks`.`class_id` = ' . $class_id . '
        //         AND `marks`.`subject_id` = ' . $subject_id . '
        //         AND `marks`.`date` = ' . $date . '
        //         ORDER BY CONVERT(`user`.`name` USING utf8) COLLATE utf8_unicode_ci
        //     ';
        // }

        $sql = 'SELECT `marks`.`id`, `marks`.`student_id`, `marks`.`under_title`, `marks`.`mark`, `marks`.`date` FROM `marks`
                    INNER JOIN `user`
                        ON `user`.`id` = `marks`.`student_id`
                WHERE `marks`.`class_id` = ' . $class_id . '
                AND `marks`.`subject_id` = ' . $subject_id;

        if (!is_null($date)) {
            $sql .= ' AND `marks`.`date` = ' . $date;
        }
        if (!is_null($from)) {
            $sql .= ' AND `marks`.`date` >= ' . strtotime($from);
        }
        if (!is_null($to)) {
            $sql .= ' AND `marks`.`date` <= ' . strtotime($to);
        }
        $sql .= ' ORDER BY CONVERT(`user`.`name` USING utf8) COLLATE utf8_unicode_ci';
 

        $all_marks = Yii::$app->db->createCommand($sql)->queryAll();

        $marks = [];

        foreach($all_marks as $key => $value) :

            $marks[$value['date']][$value['under_title']][$value['student_id']]['mark'][] = $value['mark'];
            $marks[$value['date']][$value['under_title']][$value['student_id']]['id'][] = $value['id'];
            
        endforeach;

        ksort($marks, SORT_ASC);

        return $marks;


    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }

    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }

}
