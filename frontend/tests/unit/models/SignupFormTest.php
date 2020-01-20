<?php
namespace frontend\tests\unit\models;

use common\fixtures\CategoryFixture;
use common\fixtures\UserFixture;
use frontend\models\SignupForm;
use common\models\Category;
use common\models\Product;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
            'firstName' => 'Unit', 
            'lastName' => 'Test', 
            'phone' => '000000000', 
            'address' => 'Unit test address', 
            'postal_code' => '1234-123', 
            'city' => 'Unit City', 
            'country' => 'Unit Country', 
            'nif' => '123456789',
        ]);

        $user = $model->signup();
        expect($user)->true();

        /** @var \common\models\User $user */
        $user = $this->tester->grabRecord('common\models\User', [
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'status' => \common\models\User::STATUS_ACTIVE,
        ]);

        $profile = $this->tester->grabRecord('common\models\Profile', [
            'firstName' => 'Unit',
            'city' => 'Unit City',
            'nif' => '123456789'
        ]);

        $profile->delete();
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('username'))
            ->equals('Este nome de utilizador já está registado.');
        expect($model->getFirstError('email'))
            ->equals('Este e-mail já está registado.');
    }

    function testSavingProduct(){
        $product = new Product();
        $product->product_name = "prod1";
        $product->unit_price = 1;
        $product->description = "desc";
        $product->id_category = 1;
        $product->save();
        $this->assertEquals('prod1', $product->product_name);
        $this->tester->seeRecord('common\models\Product', ['product_name' => 'prod1']);
    }
}
