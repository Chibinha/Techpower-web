<?php

namespace common\tests\unit;

use Codeception\Test\Unit;
use common\models\Category;

class CategoryTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
    }

    public function testDescriptionNull()
    {
        $category = new Category();
        $category->description = null;

        expect($category->validate())->false();
        expect($category->hasErrors())->true();
    }

    public function testDescriptionCorrect()
    {
        $category = new Category();
        $category->description = 'Teclados';

        expect($category->validate())->true();
    }

    public function testParentIdIncorrect()
    {
        $category1 = new Category();
        $category1->parent_id = null;
        $category2 = new Category();
        $category2->parent_id = 'abc';

        expect($category1->validate())->false();
        expect($category2->validate())->false();
        expect($category1->hasErrors())->true();
        expect($category2->hasErrors())->true();
    }
}


    


  