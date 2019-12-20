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
            ['username', 'required', 'message' => 'Introduza um nome de utilizador.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nome de utilizador já está registado.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 
            'tooShort' => 'O nome de utilizador tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome de utilizador não pode exceder os 255 digitos.'],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Introduza um e-mail.'],
            ['email', 'email', 'message' => 'Introduza um e-mail válido.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este e-mail já está registado.'],
            ['email', 'string', 'max' => 255],

            ['password', 'required', 'message' => 'Introduza uma password.'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'A password tem que ter no mínimo 6 digitos.'],

            ['firstName', 'trim'],
            ['firstName', 'required', 'message' => 'Introduza um nome.'],
            ['firstName', 'string', 'min' => 2, 'max' => 50, 
            'tooShort' => 'O nome tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome não pode exceder os 50 digitos.'],

            ['lastName', 'trim'],
            ['lastName', 'required', 'message' => 'Introduza um apelido.'],
            ['lastName', 'string', 'min' => 2, 'max' => 50, 
            'tooShort' => 'O apelido tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O apelido não pode exceder os 50 digitos.'],

            ['phone', 'trim'],
            ['phone', 'integer', 'message' => 'Número de telefone incorreto.'],
            ['phone', 'required', 'message' => 'Introduza um número de telefone.'],
            ['phone', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O número de telefone tem que ter 9 dígitos.', 
                'tooLong' => 'O número de telefone tem que ter 9 dígitos.'],

            ['address', 'trim'],
            ['address', 'required', 'message' => 'Introduza uma morada.'],
            ['address', 'string', 'min' => 2, 'max' => 255, 
            'tooShort' => 'A morada tem que ter no mínimo 2 digitos.',
            'tooLong' => 'A morada não pode exceder os 255 digitos.'],

            ['nif', 'trim'],
            ['nif', 'integer', 'message' => 'NIF incorreto.'],
            ['nif', 'required', 'message' => 'Introduza um NIF.'],
            ['nif', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'NIF já registado.'],
            ['nif', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O NIF tem que ter 9 dígitos.' , 
                'tooLong' => 'O NIF tem que ter 9 dígitos.',],

            ['postal_code', 'trim'],
            ['postal_code', 'required', 'message' => 'Introduza um código de postal.'],
            ['postal_code', 'string', 'min' => 4, 'max' => 8, 
            'tooShort' => 'O código de postal tem que ter no mínimo 4 digitos.',
            'tooLong' => 'O código de postal não pode exceder os 8 digitos.'],

            ['city', 'trim'],
            ['city', 'required', 'message' => 'Introduza uma cidade.'],
            ['city', 'string', 'min' => 2, 'max' => 50, 
            'tooShort' => 'O nome da cidade tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome da cidade não pode exceder os 50 digitos.'],

            ['country', 'trim'],
            ['country', 'required', 'message' => 'Introduza um país.'],
            ['country', 'string', 'min' => 2, 'max' => 100, 
            'tooShort' => 'O nome do país tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome do país não pode exceder os 100 digitos.'],
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

        $profile = new Profile();
        $profile->firstName = $this->firstName;
        $profile->lastName = $this->lastName;
        $profile->phone = $this->phone;
        $profile->address = $this->address;
        $profile->nif = $this->nif;
        $profile->postal_code = $this->postal_code;
        $profile->city = $this->city;
        $profile->country = $this->country;
        $profile->id_user = $user->id;
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
