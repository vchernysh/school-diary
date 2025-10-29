<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "a_payments_for_all_school".
 *
 * @property string $id
 * @property int $school_id
 * @property int $amount
 * @property string $currency
 * @property string $date_from
 * @property string $date_to
 * @property int $unix_date_from
 * @property int $unix_date_to
 */
class PaymentsForAllSchool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'a_payments_for_all_school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'currency', 'date_from', 'date_to', 'unix_date_from', 'unix_date_to'], 'required'],
            ['school_id', 'required', 'message' => 'Необхідно вибрати "Школу".'],
            [['school_id', 'amount', 'unix_date_from', 'unix_date_to'], 'integer'],
            [['currency'], 'string', 'max' => 200],
            [['date_from', 'date_to'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID оплати',
            'school_id' => 'Школа',
            'amount' => 'Сума',
            'currency' => 'Валюта',
            'date_from' => 'Від',
            'date_to' => 'До',
            'unix_date_from' => 'Від',
            'unix_date_to' => 'До',
        ];
    }

    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'school_id']);
    }
}
