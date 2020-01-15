<?php

namespace frontend\tests\unit\models;

use common\models\SaleItem;

class SaleItemTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testSaleItemIdNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->id = "Not Number";
        $this->assertFalse($saleItem->validate(['id']));
    }

    public function testSaleItemPriceNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->unit_price = "Not Number";
        $this->assertFalse($saleItem->validate(['unit_price']));
    }

    public function testSaleItemPriceNull(){        
        $saleItem = new SaleItem();
        $saleItem->unit_price = null;
        $this->assertFalse($saleItem->validate(['unit_price']));
    }

    public function testSaleItemPriceCorrect(){        
        $saleItem = new SaleItem();
        $saleItem->unit_price = 59.99;
        $this->assertTrue($saleItem->validate(['unit_price']));
    }

    public function testSaleItemIdProductNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->id_product = "Not Number";
        $this->assertFalse($saleItem->validate(['id_product']));
    }

    public function testSaleItemIdProductNull(){        
        $saleItem = new SaleItem();
        $saleItem->id_product = null;
        $this->assertFalse($saleItem->validate(['id_product']));
    }

    public function testSaleItemIdSaleNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->id_sale = "Not Number";
        $this->assertFalse($saleItem->validate(['id_sale']));
    }

    public function testSaleItemIdSaleNull(){        
        $saleItem = new SaleItem();
        $saleItem->id_sale = null;
        $this->assertFalse($saleItem->validate(['id_sale']));
    }
}
