<?php

namespace app\models;

use yii\db\ActiveRecord;

class Route extends ActiveRecord
{

    public static function tableName()
    {
        return '{{route}}';
    }

    public function rules()
    {
        /*
         * Will define proper rules later
         * Stub rules allow us to use update and create
         * functions in RESTapi
         */
        return [
            [
                [
                    'origin',
                    'departure',
                    'destination',
                    'arrival',
                    'longevity',
                    'price',
                    'company',
                    'schedule'],
                'safe'
            ],
        ];
    }
}
