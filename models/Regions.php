<?php

namespace app\models;

use Yii;
    // use app\models\Cities;

/**
 * This is the model class for table "regions".
 *
 * @property int $id
 * @property string $name
 */
class Regions extends \yii\db\ActiveRecord
{

    public $count_cities;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 300],
            ['count_cities', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Область',
            'count_cities' => 'Кількість міст',
        ];
    }

    public function getCities()
    {
        $cities = $this->hasMany(Cities::className(), ['region_id' => 'id']);
        return $cities->count();
    }

}
