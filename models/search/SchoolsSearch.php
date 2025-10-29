<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Schools;

/**
 * SchoolsSearch represents the model behind the search form of `app\models\Schools`.
 */
class SchoolsSearch extends Schools
{

    public $region_name, $city_name, $director_name, $custom_test_type, $custom_payment_for_school;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price', 'max_students', 'price_for_all_school'], 'integer'],
            [['name', 'region_name', 'city_name', 'city_id', 'region_id', 'director_name', 'custom_test_type', 'custom_payment_for_school', 'is_test', 'price_for_all_school', 'max_students'], 'safe'],
        ];
    }

    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['region_name', 'city_name', 'director_name', 'custom_test_type', 'custom_payment_for_school']);
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
        $query = Schools::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_ASC]],
        ]);

        $query->joinWith(['region', 'city', 'director', 'cyrillic_test_type']);

        $dataProvider->sort->attributes['region_name'] = [
            'asc' => ['regions.name' => SORT_ASC],
            'desc' => ['regions.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['custom_test_type'] = [
            'asc' => ['_params_translations.cyrillic_name' => SORT_ASC],
            'desc' => ['_params_translations.cyrillic_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['custom_payment_for_school'] = [
            'asc' => ['_params_translations.cyrillic_name' => SORT_ASC],
            'desc' => ['_params_translations.cyrillic_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['city_name'] = [
            'asc' => ['cities.name' => SORT_ASC],
            'desc' => ['cities.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['director_name'] = [
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
            'schools.id' => $this->id, 
            'price' => $this->price, 
            // 'is_test' => $this->is_test
        ]);

        $query->andFilterWhere(['LIKE', 'regions.name', $this->region_name]);

        $query->andFilterWhere(['LIKE', 'cities.name', $this->city_name]);

        $query->andFilterWhere(['LIKE', 'user.name', $this->director_name]);

        $query->andFilterWhere(['like', 'schools.name', $this->name]);

        $query->andFilterWhere(['like', 'schools.price_for_all_school', $this->price_for_all_school]);

        $query->andFilterWhere(['like', 'schools.max_students', $this->max_students]);

        $query->andFilterWhere(['like', '_params_translations.cyrillic_name', $this->custom_test_type]);
        
        $query->andFilterWhere(['like', '_params_translations.cyrillic_name', $this->custom_payment_for_school]);

        return $dataProvider;
    }
}
