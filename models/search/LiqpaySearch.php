<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Liqpay;

/**
 * LiqpaySearch represents the model behind the search form of `app\models\Liqpay`.
 */
class LiqpaySearch extends Liqpay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_id', 'order_id', 'amount'], 'integer'],
            [['currency', 'status', 'action', 'paytype', 'liqpay_order_id', 'sender_first_name', 'sender_last_name', 'sender_phone', 'sender_card_mask2', 'sender_card_bank', 'sender_card_type', 'sender_card_country', 'ip', 'description', 'create_date', 'end_date'], 'safe'],
            [['receiver_commission', 'amount_with_receiver_commission'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Liqpay::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'payment_id' => $this->payment_id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'receiver_commission' => $this->receiver_commission,
            'amount_with_receiver_commission' => $this->amount_with_receiver_commission,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'paytype', $this->paytype])
            ->andFilterWhere(['like', 'liqpay_order_id', $this->liqpay_order_id])
            ->andFilterWhere(['like', 'sender_first_name', $this->sender_first_name])
            ->andFilterWhere(['like', 'sender_last_name', $this->sender_last_name])
            ->andFilterWhere(['like', 'sender_phone', $this->sender_phone])
            ->andFilterWhere(['like', 'sender_card_mask2', $this->sender_card_mask2])
            ->andFilterWhere(['like', 'sender_card_bank', $this->sender_card_bank])
            ->andFilterWhere(['like', 'sender_card_type', $this->sender_card_type])
            ->andFilterWhere(['like', 'sender_card_country', $this->sender_card_country])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'create_date', $this->create_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date]);

        return $dataProvider;
    }
}
