<?php

namespace app\models;

use Yii;
    use yii\db\ActiveRecord;

class Directors extends ActiveRecord
{

	public $custom_type;

    public static function tableName()
    {

        return 'directors';

        // END public static function tableName();
    }

    public function getDirector()
    {
    	return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCyrillic_type()
    {
        return $this->hasOne(ParamsTranslations::className(), ['english_name' => 'type'])
        	->via('director');
    }

    public function getCustom_type()
    {
        return $this->cyrillic_type->cyrillic_name;
    }

}
