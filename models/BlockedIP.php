<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "_blocked_ip".
 *
 * @property int $id
 * @property string $ip
 * @property int $time
 */
class BlockedIP extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '_blocked_ip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'time'], 'required'],
            [['time'], 'integer'],
            [['ip'], 'string', 'max' => 30],
            [['ip'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'time' => 'Time',
        ];
    }
}
