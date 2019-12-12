<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Registar', 'h1');
        $I->see('Por favor preencha os seguintes campos:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Introduza um nome de utilizador.');
        $I->seeValidationError('Introduza um e-mail.');
        $I->seeValidationError('Introduza uma password.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]'  => 'tester',
            'SignupForm[email]'     => 'ttttt',
            'SignupForm[password]'  => 'tester_password',
        ]
        );
        $I->dontSee('Introduza um nome de utilizador.', '.help-block');
        $I->dontSee('Introduza uma password.', '.help-block');
        $I->see('Introduza um e-mail válido.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm('$this->formId', [
            'SignupForm[username]' => 'tester',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
            'SignupForm[firstName]' => 'Unit', 
            'SignupForm[lastName]' => 'Test', 
            'SignupForm[phone]' => '000000000', 
            'SignupForm[address]' => 'Unit test address', 
            'SignupForm[postal_code]' => '1234-123', 
            'SignupForm[city]' => 'Unit City', 
            'SignupForm[country]' => 'Unit Country', 
            'SignupForm[nif]' => '123456789', 
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'tester',
            'email' => 'tester.email@example.com',
        ]);

        $I->seeRecord('common\models\Profile', [
            'firstName' => 'Unit', 
            'lastName' => 'Test', 
            'phone' => '000000000', 
            'address' => 'Unit test address', 
            'postal_code' => '1234-123', 
            'city' => 'Unit City', 
            'country' => 'Unit Country', 
            'nif' => '123456789', 
        ]);

        $I->seeEmailIsSent();
        $I->see('Registo efetuado com sucesso.');
    }
}
