<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_about_school".
 *
 * @property int $school_id
 * @property string $info
 */
class InfoAboutSchool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'info_about_school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['school_id', 'required'],
            [['school_id'], 'integer'],
            ['info', 'string'],
            [['school_id'], 'unique'],
            ['info', 'default', 'value' => null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'school_id' => 'School ID',
            'info' => 'Інформація про школу',
        ];
    }

    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'school_id']);
    }
}
