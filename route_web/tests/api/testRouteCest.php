<?php


class testRouteCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests
    public function canGetRoutesList(ApiTester $I)
    {
        $I->haveHttpHeader("Accept", "application/json");
        $I->sendGET('routes');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"id":1');
        $I->seeResponseContains('"id":5');
    }

    public function canGetRouteById(ApiTester $I)
    {
        $I->haveHttpHeader("Accept", "application/json");
        $I->sendGET('routes/2');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains('"origin":"beta"');
    }
}
