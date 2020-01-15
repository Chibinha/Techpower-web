<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class SaleCest
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

    // public function _before(FunctionalTester $I)
    // {
    //     $I->amOnPage('/site/login');
    //     $I->fillField('Username', 'erau');
    //     $I->fillField('Password', 'password_0');
    //     $I->click('login-button');

    //     $I->amOnPage('/');
    // }

    // public function finishSale(FunctionalTester $I)
    // {
    //     $I->see('Sales for Shipping', 'h1');
    //     $I->click('Ver', 'a');
    //     $I->See('A preparar encomenda');
    //     $I->SeeLink('Update');
    //     $I->click('Update');
    //     $I->see('Sale Finished');
    //     $I->click('sale-sale_finished');
    //     $I->click('Save','button');
    //     $I->See('Encomenda expedida');
    // }

    // public function removeSaleItem(FunctionalTester $I)
    // {
    //     $I->see('Sales for Shipping', 'h1');
    //     $I->click('Sales', 'a');
    //     $I->See('Sales', 'h1');
    //     $I->click('Update', 'a');
    //     $I->dontSee('Esta venda não contem nenhuns produtos.', 'b');
    //     $I->See('Remover Item', 'a');
    //     $I->See('Esta venda não contem nenhuns produtos.', 'b');
    // }
}
