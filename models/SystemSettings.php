<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "__system_settings".
 *
 * @property int $id
 * @property int $stop
 */
class SystemSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '__system_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stop'], 'required'],
            [['id', 'stop'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stop' => 'Зупинити систему?',
        ];
    }
}
