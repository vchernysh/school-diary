<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "school_staff".
 *
 * @property int $id
 * @property int $school_id
 * @property string $name
 * @property string $position
 * @property int $birthday
 * @property string $image
 */
class SchoolStaff extends \yii\db\ActiveRecord
{

    public $img, $birthday_string;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'school_staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            ['birthday', 'integer'],
            ['birthday_string', 'string'],
            [['name', 'position'], 'string', 'max' => 200],
            [['img'], 'file', 'maxSize' => 1024 * 1024 * 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school_id' => 'School ID',
            'name' => 'Ім\'я',
            'position' => 'Посада',
            'birthday' => 'День народження',
            'birthday_string' => 'День народження',
            'image' => 'Зображення',
            'img' => 'Зображення',
        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {
            $this->img->saveAs('uploads/school-staff/' . $id . '.' . $this->img->extension);
            return true;
        } else {
            return false;
        }
    }
}
