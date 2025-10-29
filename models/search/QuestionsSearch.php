<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Questions;


/**
 * QuestionsSearch represents the model behind the search form of `app\models\Questions`.
 */
class QuestionsSearch extends Questions
{

    public $custom_type, $custom_status, $user_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['type_message', 'message', 'date', 'custom_type', 'custom_status', 'user_name'], 'safe'],
        ];
    }

    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['custom_type', 'custom_status', 'user_name']);
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

        $query = Questions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => [
                'id' => SORT_DESC
            ]]
        ]);

        $query->joinWith(['cyrillic_type t', 'cyrillic_status s', 'user']);

        $dataProvider->sort->attributes['custom_type'] = [
            'asc' => ['t.cyrillic_name' => SORT_ASC],
            'desc' => ['t.cyrillic_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['custom_status'] = [
            'asc' => ['s.cyrillic_name' => SORT_ASC],
            'desc' => ['s.cyrillic_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user_name'] = [
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'questions.id' => $this->id,
            'questions.user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'type_message', $this->type_message])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 't.cyrillic_name', $this->custom_type])
            ->andFilterWhere(['like', 's.cyrillic_name', $this->custom_status])
            ->andFilterWhere(['like', 'user.name', $this->user_name]);

        return $dataProvider;
    }
}
