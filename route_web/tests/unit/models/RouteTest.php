<?php

namespace tests\unit\models;

use app\models\Route;

class RouteTest extends \Codeception\Test\Unit
{
    public function testRouteCanBeFoundById()
    {
        expect_that($route = Route::findOne(1));
        expect($route->origin)->equals('alpha');
    }

    public function testCanCreateNewRoute()
    {
        expect_that($route = new Route());
        $route->origin = "createdorigin";
        $route->save();
        expect_that($newRoute = Route::findOne($route->id));
        expect($newRoute->origin)->equals('createdorigin');
    }

    public function testCanChangeRouteOrigin()
    {
        $route = Route::findOne(4);
        $route->origin = 'neworigin';
        $route->save();

        $newRoute = Route::find()
                  ->where(['origin' => 'neworigin'])
                  ->one();
        expect($newRoute->id)->equals(4);
    }
}


?>
