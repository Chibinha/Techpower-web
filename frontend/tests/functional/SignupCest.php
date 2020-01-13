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
        $I->see('Registar nova conta', 'h1');
        $I->see('Por favor preencha os seguintes campos:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Introduza um nome de utilizador.');
        $I->seeValidationError('Introduza um e-mail.');
        $I->seeValidationError('Introduza uma password.');
        $I->seeValidationError('Introduza um nome.');
        $I->seeValidationError('Introduza um apelido.');
        $I->seeValidationError('Introduza um número de telefone.');
        $I->seeValidationError('Introduza uma morada.');
        $I->seeValidationError('Introduza um NIF.');
        $I->seeValidationError('Introduza um código de postal.');
        $I->seeValidationError('Introduza uma cidade.');
        $I->seeValidationError('Introduza um país.');
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]'  => 'tester',
            'SignupForm[email]'     => 'ttttt',
            'SignupForm[password]'  => 'tester_password',
            'SignupForm[firstName]'  => 'tester',
            'SignupForm[lastName]'     => 'ttttt',
            'SignupForm[phone]'  => '999999999',
            'SignupForm[address]'  => 'tester',
            'SignupForm[postal_code]'     => '1234-123',
            'SignupForm[city]'  => 'test',
            'SignupForm[country]'  => 'tester',
            'SignupForm[nif]'     => '555555555',
        ]
        );
        $I->dontSee('Introduza um nome de utilizador.');
        $I->dontSee('Introduza uma password.');
        $I->dontSee('Introduza um nome.');
        $I->dontSee('Introduza um apelido.');
        $I->dontSee('Introduza um número de telefone.');
        $I->dontSee('Introduza uma morada.');
        $I->dontSee('Introduza um código de postal.');
        $I->dontSee('Introduza uma cidade.');
        $I->dontSee('Introduza um país.');
        $I->dontSee('Introduza um NIF.');
        $I->see('Introduza um e-mail válido.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
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
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $profile = $I->grabRecord('common\models\Profile', [
            'firstName' => 'Unit',
            'city' => 'Unit City',
            'nif' => '123456789'
        ]);

        $I->see('Registo efetuado com sucesso.');

        $profile->delete();
    }
}
