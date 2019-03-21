<?php

namespace app\models;

use yii\db\ActiveRecord;

class Route extends ActiveRecord
{

    public static function tableName()
    {
        return '{{route}}';
    }
}
