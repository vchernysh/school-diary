<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Telegram;

/**
 * TelegramSearch represents the model behind the search form of `app\models\Telegram`.
 */
class TelegramSearch extends Telegram
{

    public $name, $email, $username, $custom_status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['telegram_chat_id', 'name', 'email', 'username', 'custom_status'], 'safe'],
        ];
    }

    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['name', 'email', 'username', 'custom_status']);
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
        $query = Telegram::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['user_id' => SORT_ASC]]
        ]);

        $query->joinWith(['user', 'cyrillic_status']);


        $dataProvider->sort->attributes['custom_status'] = [
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
        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'telegram_chat_id', $this->telegram_chat_id])
            ->andFilterWhere(['LIKE', 'user.name', $this->name])
            ->andFilterWhere(['LIKE', 'user.email', $this->email])
            ->andFilterWhere(['LIKE', 'user.username', $this->username])
            ->andFilterWhere(['like', '_params_translations.cyrillic_name', $this->custom_status]);

        return $dataProvider;
    }
}
