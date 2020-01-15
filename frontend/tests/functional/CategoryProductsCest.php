<?php

namespace frontend\tests\functional;

use common\fixtures\CategoryFixture;
use common\fixtures\ProductFixture;
use common\fixtures\ProfileFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class CategoryProductsCest
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
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php'
            ],
            'product' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product_data.php'
            ]
        ];
    }

    public function _before()
    {
    }

    public function seeCategoryProducts(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Categorias');
        $I->click('Categorias');
        $I->see('Componentes');
        $I->click('Componentes');
        $I->see('Processador');
    }
}