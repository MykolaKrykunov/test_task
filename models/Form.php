<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 *
 * @property Country $country
 * @property Hotel[] $hotels
 */
class Form extends Model
{
    public $country_id;
    public $city_id;
    public $hotel_id;
    public $countries;
    public $cities;
    public $hotels;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'city_id', 'hotel_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country',
            'city_id' => 'City',
            'hotel_id' => 'Hotel',
        ];
    }

    public function getFormCountries()
    {
        $result[0] = '';
        $models = Country::find()->all();
        foreach($models as $model)
        {
            $result[$model->id] = $model->name;
        }
        return $result;
    }

    public function getFormCities()
    {
        $result[0] = '';
        $models = City::find()->all();
        foreach($models as $model)
        {
            $result[$model->id] = $model->name;
        }
        return $result;
    }

    public function getFormHotels()
    {
        $result[0] = '';
        $models = Hotel::find()->all();
        foreach($models as $model)
        {
            $result[$model->id] = $model->name;
        }
        return $result;
    }
}
