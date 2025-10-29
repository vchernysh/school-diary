<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Payments;

/**
 * PaymentsSearch represents the model behind the search form of `app\models\Payments`.
 */
class PaymentsSearch extends Payments
{

    public $studentName, $payerName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'payment_id', 'payer_id', 'student_id', 'amount', 'unix_date_from', 'unix_date_to'], 'integer'],
            [['currency', 'date_from', 'date_to', 'studentName', 'payerName'], 'safe'],
        ];
    }

    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['studentName', 'payerName']);
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
        $query = Payments::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => [
                'unix_date_from' => SORT_DESC
            ]]
        ]);

        $query->joinWith(['student s', 'payer p']);

        $dataProvider->sort->attributes['studentName'] = [
            'asc' => ['s.name' => SORT_ASC],
            'desc' => ['s.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['payerName'] = [
            'asc' => ['p.name' => SORT_ASC],
            'desc' => ['p.name' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'payment_id' => $this->payment_id,
            'payer_id' => $this->payer_id,
            'student_id' => $this->student_id,
            'amount' => $this->amount,
            'unix_date_from' => $this->unix_date_from,
            'unix_date_to' => $this->unix_date_to,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'date_from', $this->date_from])
            ->andFilterWhere(['like', 'date_to', $this->date_to])
            ->andFilterWhere(['LIKE', 's.name', $this->studentName])
            ->andFilterWhere(['LIKE', 'p.name', $this->payerName]);

        return $dataProvider;
    }
}
