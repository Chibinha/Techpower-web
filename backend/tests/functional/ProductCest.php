<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\CategoryFixture;
use common\fixtures\ProductFixture;
use common\fixtures\UserFixture;

class ProductCest
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
            ],
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php'
            ],
            'product' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {

        $I->amOnPage('/site/login');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->amOnPage('/product/index');
    }

    public function addProduct(FunctionalTester $I)
    {
        $I->see('Products', 'h1');
        $I->click('Create Product');
        $I->see('Create Product');
        $I->fillField('Product Name', 'test');
        $I->fillField('Unit Price', '1.11');
        $I->fillField('Description', 'test product');
        $I->click('Save');
        $I->see('Product: test');
        $I->seeRecord('common\models\Product', ['Description' => 'test product']);
    }

    public function updateProduct(FunctionalTester $I)
    {
        $I->seeRecord('common\models\Product', ['product_name' => 'TESTE']);
        $I->amOnPage('/product/view?id=1');
        $I->see('Update');
        $I->click('Update');
        $I->fillField('Product Name', 'Updated_Product');
        $I->fillField('Unit Price', '999.99');
        $I->fillField('Description', 'updated test product');
        $I->click('Save');
        $I->see('Product: Updated_Product');
        $I->seeRecord('common\models\Product', ['Description' => 'updated test product']);
    }
}
