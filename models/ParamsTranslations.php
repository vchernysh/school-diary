<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;

class ParamsTranslations extends ActiveRecord
{

    public static function tableName()
    {

        return '_params_translations';

        // END public static function tableName();
    }

    public function attributeLabels()
    {
    	return [
    		'id' => 'ID',
            'english_name' => 'English',
            'cyrillic_name' => 'Кирилиця',
    	];
    }


}
