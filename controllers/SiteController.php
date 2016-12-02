<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Form;
use app\models\Hotel;
use app\models\City;
use app\models\Country;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Form();
        $model->countries = $model->formCountries;
        $model->cities = $model->formCities;
        $model->hotels = $model->formHotels;

        if($model->load(Yii::$app->request->post()))
        {
            if($model->hotel_id>0)
            {
                $hotel = Hotel::findOne($model->hotel_id);
                $model->city_id = $hotel->city->id;
                $model->country_id = $hotel->city->country->id;
            }elseif($model->city_id>0)
            {
                $city = City::findOne($model->city_id);
                $model->hotels = $city->formHotels;
                $model->country_id = $city->country->id;
            }elseif($model->country_id>0)
            {
                $country = Country::findOne($model->country_id);
                $model->cities = $country->formCities;
                $model->hotels = $country->formHotels;
            }
            return $this->render('index', compact('model'));
        }
    
        return $this->render('index', compact('model'));
    }
}
