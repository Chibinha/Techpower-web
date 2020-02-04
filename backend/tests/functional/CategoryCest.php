<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class CategoryCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
    }

    public function addCategory(FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage('/category/index');
        $I->see('Categories', 'h1');
        $I->click('Create Category');
        $I->see('Create Category');
        $I->fillField('Description', 'test category');
        $I->click('Save');
        $I->see('Category: test category');
    }
}
