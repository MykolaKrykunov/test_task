<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $name
 *
 * @property City[] $cities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['country_id' => 'id']);
    }

    public function getFormCities()
    {
        $result = [];
        foreach(City::find()->where(['country_id' => $this->id])->all() as $city)
        {
            $reslut[$city->id] = $city->name;
        }
        return $result;
    }


    public function getFormHotels()
    {
        $hotels = [];
        foreach(City::find()->where(['country_id' => $this->id])->all() as $city)
        {
            $hotels = array_merge($hotels, $city->hotels);
        }
        $result = [];
        foreach($hotels as $hotel)
        {
            $result[$hotel->id] = $hotel->name;
        }
        return $result;
    }
}
