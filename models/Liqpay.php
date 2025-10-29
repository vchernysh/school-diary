<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "liqpay".
 *
 * @property int $id
 * @property int $payment_id ID платежа в системе LiqPay
 * @property int $order_id Order_id платежа
 * @property string $currency Валюта платежа
 * @property string $status
 * @property int $amount Сумма платежа
 * @property double $receiver_commission Комиссия с получателя в валюте платежа
 * @property double $amount_with_receiver_commission Сумма платежа учитывая комиссию с получателя
 * @property string $action
 * @property string $paytype Способ оплаты. Возможные значения card - оплата картой, liqpay - через кабинет liqpay, privat24 - через кабинет приват24, masterpass - через кабинет masterpass, moment_part - рассрочка, cash - наличными, invoice - счет на e-mail, qr - сканирование qr-кода.
 * @property string $liqpay_order_id
 * @property string $sender_first_name
 * @property string $sender_last_name
 * @property string $sender_phone
 * @property string $sender_card_mask2 Карта отправителя
 * @property string $sender_card_bank Банк отправителя
 * @property string $sender_card_type Тип карты отправителя MasterCard/Visa
 * @property string $sender_card_country Страна карты отправителя. Цифровой ISO 3166-1 код
 * @property string $ip
 * @property string $description
 * @property string $create_date Дата создания платежа
 * @property string $end_date Дата завершения/изменения платежа
 */
class Liqpay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'a_liqpay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'order_id', 'currency', 'status', 'amount', 'receiver_commission', 'amount_with_receiver_commission', 'action', 'paytype', 'liqpay_order_id', 'create_date', 'end_date'], 'required'],
            [['payment_id', 'order_id', 'amount'], 'integer'],
            [['status', 'action', 'paytype', 'description'], 'string'],
            [['receiver_commission', 'amount_with_receiver_commission'], 'number'],
            [['currency', 'sender_phone'], 'string', 'max' => 50],
            [['liqpay_order_id', 'sender_first_name', 'sender_last_name', 'sender_card_mask2', 'sender_card_bank', 'sender_card_type', 'sender_card_country', 'ip'], 'string', 'max' => 250],
            [['create_date', 'end_date'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'order_id' => 'Order ID',
            'currency' => 'Currency',
            'status' => 'Status',
            'amount' => 'Amount',
            'receiver_commission' => 'Receiver Commission',
            'amount_with_receiver_commission' => 'Amount With Receiver Commission',
            'action' => 'Action',
            'paytype' => 'Paytype',
            'liqpay_order_id' => 'Liqpay Order ID',
            'sender_first_name' => 'Sender First Name',
            'sender_last_name' => 'Sender Last Name',
            'sender_phone' => 'Sender Phone',
            'sender_card_mask2' => 'Sender Card Mask2',
            'sender_card_bank' => 'Sender Card Bank',
            'sender_card_type' => 'Sender Card Type',
            'sender_card_country' => 'Sender Card Country',
            'ip' => 'Ip',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'end_date' => 'End Date',
        ];
    }
}
