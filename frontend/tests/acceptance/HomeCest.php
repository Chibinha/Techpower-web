<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class CartCest
{
    public function checkAddToCart(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->see("Novidades");
        $I->click("Placa Gráfica Gigabyte Aorus GeForce RTX 2080 Ti W");
        
        $I->see("Placa Gráfica Gigabyte Aorus GeForce RTX 2080 Ti W");
        $I->see('Add to cart');
        // Need to reload because of bug
        // https://stackoverflow.com/questions/54264398/codeception-webdriver-acceptance-test-cant-click-on-an-element-it-can-see
        $I->reloadPage();
        $I->click('Add to cart');
        $I->see("Produto adicionado ao carrinho.");

        $I->see("Carrinho");
        $I->click("Carrinho");
        $I->amOnPage(Url::toRoute('/site/cart'));
        $I->see('Checkout');
        $I->see('Placa Gráfica Gigabyte Aorus GeForce RTX 2080 Ti W');
    }
}
