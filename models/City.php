<?php

namespace app\models;

use Yii;
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
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotels()
    {
        return $this->hasMany(Hotel::className(), ['city_id' => 'id']);
    }

    public function getFormHotels()
    {
        $result = [];
        foreach(Hotel::find()->where(['city_id' => $this->id])->all() as $hotel)
        {
            $reslut[$hotel->id] = $hotel->name;
        }
        return $result;
    }

    public function getAllCountries()
    {
        return ArrayHelper::map(Country::find()->all(), 'id', 'name');
    }
}
