<?php

namespace frontend\tests\unit\models;

use common\models\Sale;

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

    public function testSaleStateNull(){        
        $sale = new Sale();
        $sale->sale_finished = 3;
        $this->assertFalse($sale->validate(['sale_finished']));
    }

    public function testSaleStateCorrect(){        
        $sale = new Sale();
        $sale->sale_finished = 1;
        $sale2 = new Sale();
        $sale2->sale_finished = 0;
        $this->assertTrue($sale->validate(['sale_finished']));
        $this->assertTrue($sale2->validate(['sale_finished']));
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
