<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $payer_id
 * @property int $student_id
 * @property string $status
 * @property string $currency
 * @property int $amount
 * @property int $date
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'a_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payer_id', 'student_id', 'currency', 'amount', 'date'], 'required'],
            [['payer_id', 'student_id', 'amount', 'date'], 'integer'],
            [['status'], 'string'],
            [['currency'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payer_id' => 'Payer ID',
            'student_id' => 'Student ID',
            'status' => 'Status',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'date' => 'Date',
        ];
    }
}
