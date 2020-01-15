<?php

namespace frontend\tests\functional;

use common\fixtures\CategoryFixture;
use common\fixtures\ProfileFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class UserCest
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
            ],
            'profile' => [
                'class' => ProfileFixture::className(),
                'dataFile' => codecept_data_dir() . 'profile_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Nome de Utilizador', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('login-button');

        $I->amOnPage('/product/index');
    }

    public function updateUserData(FunctionalTester $I)
    {
        $I->see('A minha conta');
        $I->click('A minha conta');
        $I->see('Informações da Conta');
        $I->click('Informações da Conta');
        $I->see('Alterar Dados');
        $I->fillField('Nome', 'Nome test');
        $I->fillField('Rua', 'Rua test');
        $I->click('Alterar dados');
        $I->see('Dados guardados com sucesso');
        $I->seeInField('Nome', 'Nome test');
        $I->seeInField('Rua', 'Rua test');
    }

    public function updateUserWithInvalidNif(FunctionalTester $I)
    {
        $I->see('A minha conta');
        $I->click('A minha conta');
        $I->see('Informações da Conta');
        $I->click('Informações da Conta');
        $I->see('Alterar Dados');
        $I->fillField('NIF', '123');
        $I->click('Alterar dados');
        $I->see('O NIF tem que ter 9 dígitos.');
    }

    public function updateUserWithInvalidPhone(FunctionalTester $I)
    {
        $I->see('A minha conta');
        $I->click('A minha conta');
        $I->see('Informações da Conta');
        $I->click('Informações da Conta');
        $I->see('Alterar Dados');
        $I->fillField('Telefone', '123');
        $I->click('Alterar dados');
        $I->see('O número de telefone tem que ter 9 dígitos.');
    }
}