<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $order_id
 * @property int $payment_id
 * @property int $payer_id
 * @property int $student_id
 * @property int $amount
 * @property string $currency
 * @property string $date_from
 * @property string $date_to
 * @property int $unix_date_from
 * @property int $unix_date_to
 */
class Payments extends \yii\db\ActiveRecord
{

    public $status;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'a_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'payment_id', 'payer_id', 'student_id', 'amount', 'currency', 'date_from', 'date_to', 'unix_date_from', 'unix_date_to'], 'required'],
            [['order_id', 'payment_id', 'payer_id', 'student_id', 'amount', 'unix_date_from', 'unix_date_to'], 'integer'],
            [['currency'], 'string', 'max' => 200],
            [['date_from', 'date_to'], 'string', 'max' => 150],
            ['status', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '№ оплати',
            'payment_id' => '№ платежу',
            'payer_id' => 'ID платника',
            'student_id' => 'ID учня',
            'studentName' => 'Учень',
            'payerName' => 'Платник',
            'amount' => 'Сума',
            'currency' => 'Валюта',
            'date_from' => 'Дата оплати',
            'date_to' => 'До',
            'unix_date_from' => 'Unix Date From',
            'unix_date_to' => 'Unix Date To',
            'status' => 'Статус',
        ];
    }

    public function getLiqpay()
    {
        return $this->hasOne(Liqpay::className(), ['order_id' => 'order_id']);
    }

    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }

    public function getPayer()
    {
        return $this->hasOne(User::className(), ['id' => 'payer_id']);
    }

    public function getPayerName()
    {
        return $this->payer->name;
    }

    public function getStudentName()
    {
        return $this->student->name;
    }
}
