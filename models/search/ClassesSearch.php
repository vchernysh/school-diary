<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Classes;

/**
 * ClassesSearch represents the model behind the search form of `app\models\Classes`.
 */
class ClassesSearch extends Classes
{

    public $teacher_name, $count_of_students;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'school_id'], 'integer'],
            [['name', 'teacher_name'], 'safe'],
        ];
    }

    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['teacher_name']);
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
        $query = Classes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_ASC]]
        ]);

        $query->joinWith(['teacher']);

        $dataProvider->sort->attributes['teacher_name'] = [
            'asc' => ['user.name' => SORT_ASC],
            'desc' => ['user.name' => SORT_DESC],
        ];

        // $dataProvider->sort->attributes['count_of_students'] = [
        //     'asc' => ['count' => SORT_ASC],
        //     'desc' => ['count' => SORT_DESC],
        // ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'classes.id' => $this->id,
            'classes.school_id' => $this->school_id,
            // 'count_of_students' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'classes.name', $this->name])
              ->andFilterWhere(['like', 'user.name', $this->teacher_name]);

        return $dataProvider;
    }
}
