<?php

namespace frontend\tests\unit\models;

use common\models\Category;
use common\models\Sale;
use common\models\SaleItem;

class SaleTest extends \Codeception\Test\Unit
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

    public function testSaleDateNull(){        
        $sale = new Sale();
        $sale->sale_date = null;
        $this->assertFalse($sale->validate(['sale_date']));
    }

    public function testSaleDateCorrect(){        
        $sale = new Sale();
        $sale->sale_date = "2020-01-10 16:54:54";
        $this->assertTrue($sale->validate(['sale_date']));
    }

    public function testSaleState(){  
        $sale = new Sale(); 
        $sale->sale_finished = 1;

        $state = $sale->SaleState;
        $this->assertEquals('Encomenda expedida', $state);

        $sale->sale_finished = 0;

        $state = $sale->SaleState;
        $this->assertEquals('A preparar encomenda', $state);
    }
}
