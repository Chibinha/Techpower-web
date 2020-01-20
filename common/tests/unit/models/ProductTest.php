<?php

namespace frontend\tests\unit\models;

use common\fixtures\CategoryFixture;
use common\fixtures\ProductFixture;
use common\models\Category;
use common\models\Product;

class ProductTest extends \Codeception\Test\Unit
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

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php'
            ]
        ];
    }

    public function testProductNameTooLong(){        
        $products = new Product();
        $products->product_name = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($products->validate(['product_name']));
    }

    public function testProductNameNull(){        
        $products = new Product();
        $products->product_name = null;
        $this->assertFalse($products->validate(['product_name']));
    }

    public function testProductNameCorrect(){        
        $products = new Product();
        $products->product_name = "Asus vivobook";
        $this->assertTrue($products->validate(['product_name']));
    }

    public function testProductDescriptionNull(){        
        $products = new Product();
        $products->description = null;
        $this->assertFalse($products->validate(['description']));
    }

    public function testProductDescriptionCorrect(){        
        $products = new Product();
        $products->description = "O computador portátil Asus VivoBook apresenta equilíbrio perfeito entre desempenho e beleza.";
        $this->assertTrue($products->validate(['description']));
    }

    public function testProductPriceNull(){        
        $products = new Product();
        $products->unit_price = null;
        $this->assertFalse($products->validate(['unit_price']));
    }

    public function testProductPriceCorrect(){        
        $products = new Product();
        $products->unit_price = "129.99";
        expect($products->hasErrors())->false();
        $this->assertTrue($products->validate(['unit_price']));
    }

    function testSavingProduct(){
        $product = new Product();
        $product->product_name = 'prodd2';
        $product->unit_price = 1;
        $product->description = 'desc22';
        $product->id_category = 1;
        $product->save();
        $this->assertEquals('prodd2', $product->product_name);
        $this->tester->seeRecord('common\models\Product', ['product_name' => 'prodd2', 'description' => 'desc22']);
    }
}
