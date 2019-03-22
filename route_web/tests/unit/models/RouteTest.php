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
        expect_that($route->save());
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

    public function testCanConvertTimeStrToInt()
    {
        expect(Route::timeStrToInt('15:30'))
            ->equals(15 * 60 + 30);
        expect(Route::timeStrToInt('9:00'))
            ->equals(9 * 60);
        expect(Route::timeStrToInt('23:14'))
            ->equals(23 * 60 + 14);
    }

    public function testCanConvertTimeIntToStr()
    {
        expect(Route::timeIntToStr(12 * 60 + 30))
            ->equals('12:30');
        expect(Route::timeIntToStr(30))
            ->equals('00:30');
    }

    public function testCanValidateTimeStr()
    {
        expect_that(Route::validateTimeStr('23:14'));
        expect_that(Route::validateTimeStr('13:05'));
        expect_that(Route::validateTimeStr('8:59'));
        expect_that(Route::validateTimeStr('56:59'));
        expect_not(Route::validateTimeStr('aaaa'));
        expect_not(Route::validateTimeStr('12:76'));
        expect_not(Route::validateTimeStr('12:12:12'));
        expect_not(Route::validateTimeStr('  23:12'));
        expect_not(Route::validateTimeStr('21:21 '));
    }

    public function testCanSetDepartureWithStrAndInt()
    {
        $route = new Route();

        $route->departureStr = 'a';
        expect($route->departure)->equals(null);
        expect($route->departureStr)->equals('--:--');

        $route->departureStr = '13:30';
        expect($route->departure)->equals(13 * 60 + 30);

        $route->departure = 45;
        expect($route->departureStr)->equals('00:45');
    }

    public function testCanSetArrivalWithStrAndInt()
    {
        $route = new Route();

        $route->arrivalStr = 'a';
        expect($route->arrival)->equals(null);
        expect($route->arrivalStr)->equals('--:--');

        $route->arrivalStr = '13:30';
        expect($route->arrival)->equals(13 * 60 + 30);

        $route->arrival = 45;
        expect($route->arrivalStr)->equals('00:45');
    }

    public function testCanSetLongevityWithStrAndInt()
    {
        $route = new Route();

        $route->longevityStr = 'a';
        expect($route->longevity)->equals(null);
        expect($route->longevityStr)->equals('--:--');

        $route->longevityStr = '13:30';
        expect($route->longevity)->equals(13 * 60 + 30);

        $route->longevity = 45;
        expect($route->longevityStr)->equals('00:45');
    }
}


?>
