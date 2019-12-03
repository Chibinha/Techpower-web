<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $firstName;
    public $lastName;
    public $username;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $nif;
    public $postal_code;
    public $city;
    public $country;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nome de utilizador já está registado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este e-mail já está registado.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['firstName', 'trim'],
            ['firstName', 'required'],
            ['firstName', 'string', 'min' => 2, 'max' => 50],

            ['lastName', 'trim'],
            ['lastName', 'required'],
            ['lastName', 'string', 'min' => 2, 'max' => 50],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'min' => 9, 'max' => 20],
            ['phone', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'Já existe uma conta registada com este número de telefone.'],

            ['address', 'trim'],
            ['address', 'required'],
            ['address', 'string', 'min' => 2, 'max' => 255],

            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'string', 'min' => 9, 'max' => 9],
            ['nif', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'Já existe uma conta registada com este NIF.'],

            ['postal_code', 'trim'],
            ['postal_code', 'required'],
            ['postal_code', 'string', 'min' => 4, 'max' => 8],

            ['city', 'trim'],
            ['city', 'required'],
            ['city', 'string', 'min' => 2, 'max' => 50],

            ['country', 'trim'],
            ['country', 'required'],
            ['country', 'string', 'min' => 2, 'max' => 100],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        $getlast = Yii::$app->db->getLastInsertId();

        $profile = new Profile();
        $profile->firstName = $this->firstName;
        $profile->lastName = $this->lastName;
        $profile->phone = $this->phone;
        $profile->address = $this->address;
        $profile->nif = $this->nif;
        $profile->postal_code = $this->postal_code;
        $profile->city = $this->city;
        $profile->country = $this->country;
        $profile->id_user = $getlast;
        $profile->save();

        return $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
