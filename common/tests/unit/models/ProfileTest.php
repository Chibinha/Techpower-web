<?php

namespace frontend\tests\unit\models;

use common\models\Product;
use common\models\Profile;

class ProfileTest extends \Codeception\Test\Unit
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

    public function testProfileFirstNameTooLong(){        
        $profile = new Profile();
        $profile->firstName = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($profile->validate(['firstName']));
    }

    public function testProfileFirstNameTooShort(){        
        $profile = new Profile();
        $profile->firstName = "L";
        $this->assertFalse($profile->validate(['firstName']));
    }

    public function testProfileFirstNameNull(){        
        $profile = new Profile();
        $profile->firstName = null;
        $this->assertFalse($profile->validate(['firstName']));
    }

    public function testProfileFirstNameCorrect(){        
        $profile = new Profile();
        $profile->lastName = "João";
        $this->assertTrue($profile->validate(['lastName']));
    }

    public function testProfileLastNameTooLong(){        
        $profile = new Profile();
        $profile->lastName = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($profile->validate(['lastName']));
    }

    public function testProfileLastNameTooShort(){        
        $profile = new Profile();
        $profile->lastName = "L";
        $this->assertFalse($profile->validate(['lastName']));
    }

    public function testProfileLastNameNull(){        
        $profile = new Profile();
        $profile->lastName = null;
        $this->assertFalse($profile->validate(['lastName']));
    }

    public function testProfileLastNameCorrect(){        
        $profile = new Profile();
        $profile->lastName = "Silva";
        $this->assertTrue($profile->validate(['lastName']));
    }

    public function testProfileNifTooLong(){        
        $profile = new Profile();
        $profile->nif = "12345678910";
        $this->assertFalse($profile->validate(['nif']));
    }

    public function testProfileNifTooShort(){        
        $profile = new Profile();
        $profile->nif = "12345678";
        $this->assertFalse($profile->validate(['nif']));
    }

    public function testProfileNifNull(){        
        $profile = new Profile();
        $profile->nif = null;
        $this->assertFalse($profile->validate(['nif']));
    }

    public function testProfileNifCorrect(){        
        $profile = new Profile();
        $profile->nif = "123456789";
        $this->assertTrue($profile->validate(['nif']));
    }

    public function testProfilePhoneTooLong(){        
        $profile = new Profile();
        $profile->phone = "12345678910";
        $this->assertFalse($profile->validate(['phone']));
    }

    public function testProfilePhoneTooShort(){        
        $profile = new Profile();
        $profile->phone = "12345678";
        $this->assertFalse($profile->validate(['phone']));
    }

    public function testProfilePhoneNull(){        
        $profile = new Profile();
        $profile->phone = null;
        $this->assertFalse($profile->validate(['phone']));
    }

    public function testProfilePhoneCorrect(){        
        $profile = new Profile();
        $profile->address = "123456789";
        $this->assertTrue($profile->validate(['address']));
    }

    public function testProfileAddressTooShort(){        
        $profile = new Profile();
        $profile->address = "L";
        $this->assertFalse($profile->validate(['address']));
    }

    public function testProfileAddressNull(){        
        $profile = new Profile();
        $profile->address = null;
        $this->assertFalse($profile->validate(['address']));
    }

    public function testProfileAddressCorrect(){        
        $profile = new Profile();
        $profile->address = "Rua Doutor Artur Figueiroa Rego";
        $this->assertTrue($profile->validate(['address']));
    }

    public function testProfilePostalCodeTooLong(){        
        $profile = new Profile();
        $profile->postal_code = "2050-0120";
        $this->assertFalse($profile->validate(['postal_code']));
    }

    public function testProfilePostalCodeTooShort(){        
        $profile = new Profile();
        $profile->postal_code = "205";
        $this->assertFalse($profile->validate(['postal_code']));
    }

    public function testProfilePostalCodeNull(){        
        $profile = new Profile();
        $profile->postal_code = null;
        $this->assertFalse($profile->validate(['postal_code']));
    }

    public function testProfilePostalCodeCorrect(){        
        $profile = new Profile();
        $profile->postal_code = "1234-123";
        $this->assertTrue($profile->validate(['postal_code']));
    }

    public function testProfileCityTooLong(){        
        $profile = new Profile();
        $profile->city = "tooooooooooooooooooooooooooooooooloooooooooooooooong";
        $this->assertFalse($profile->validate(['city']));
    }

    public function testProfileCityTooShort(){        
        $profile = new Profile();
        $profile->city = "L";
        $this->assertFalse($profile->validate(['city']));
    }

    public function testProfileCityNull(){        
        $profile = new Profile();
        $profile->city = null;
        $this->assertFalse($profile->validate(['city']));
    }

    public function testProfileCityCorrect(){        
        $profile = new Profile();
        $profile->city = "Leiria";
        $this->assertTrue($profile->validate(['city']));
    }

    public function testProfileCountryTooLong(){        
        $profile = new Profile();
        $profile->country = "toooooooooooooooooooooooooooooooooooooooooooooooooooooooloooooooooooooooooooooooooooooooooooooooooong";
        $this->assertFalse($profile->validate(['country']));
    }

    public function testProfileCountryTooShort(){        
        $profile = new Profile();
        $profile->country = "L";
        $this->assertFalse($profile->validate(['country']));
    }

    public function testProfileCountryNull(){        
        $profile = new Profile();
        $profile->country = null;
        $this->assertFalse($profile->validate(['country']));
    }

    public function testProfileCountryCorrect(){        
        $profile = new Profile();
        $profile->country = "Portugal";
        $this->assertTrue($profile->validate(['country']));
    }
}
