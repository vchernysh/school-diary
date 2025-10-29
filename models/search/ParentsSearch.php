<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Parents;

/**
 * ParentsSearch represents the model behind the search form of `app\models\Parents`.
 */
class ParentsSearch extends Parents
{

    public $custom_type, $child_name, $name, $email, $class_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'student_id'], 'integer'],
            [['type', 'custom_type', 'name', 'child_name', 'email', 'class_name'], 'safe'],
        ];
    }


    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['custom_type', 'child_name', 'name', 'email', 'class_name']);
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
        $query = Parents::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['user_id' => SORT_ASC]]
        ]);

        $query->joinWith(['cyrillic_type', 'user', 'child', 'class']);

        $dataProvider->sort->attributes['custom_type'] = [
            'asc' => ['_params_translations.cyrillic_name' => SORT_ASC],
            'desc' => ['_params_translations.cyrillic_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['child_name'] = [
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['class_name'] = [
            'asc' => ['classes.name' => SORT_ASC],
            'desc' => ['classes.name' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'parents.user_id' => $this->user_id,
            'parents.student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', '_params_translations.cyrillic_name', $this->custom_type])
            ->andFilterWhere(['like', 'user.name', $this->name])
            ->andFilterWhere(['like', 'user.email', $this->email])
            ->andFilterWhere(['like', 'user.name', $this->child_name])
            ->andFilterWhere(['like', 'classes.name', $this->class_name]);

        return $dataProvider;
    }
}
