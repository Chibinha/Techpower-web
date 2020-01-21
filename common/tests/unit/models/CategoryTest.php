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
    protected $category_id;

    public function _before()
    {
        $this->category_id = $this->tester->haveRecord('common\models\Category', [
            'description' => '123',
            'parent_id' => '',
        ]);
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

    function testCreatingProduct(){
        $cat = new Category();
        $cat->id = 1;
        $cat->description = "descc2";
        $cat->save();
        $this->tester->seeRecord('common\models\Category', ['description' => 'descc2']);
    }

    function testUpdatingProduct(){
        $this->tester->seeRecord('common\models\Category', ['description' => '123']);
        $category = Category::find($this->category_id)->One();
        $category->description = "changedDesc";
        $category->save();
        $this->tester->seeRecord('common\models\Category', ['description' => 'changedDesc']);
    }

    function testDeletingProduct(){
        $this->tester->seeRecord('common\models\Category', ['description' => '123']);
        $category = Category::find($this->category_id)->One();
        $category->delete();
        $this->tester->dontSeeRecord('common\models\Category', ['description' => '123']);
    }
}


    


  