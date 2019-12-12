<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $phone
 * @property string $address
 * @property int $nif
 * @property string $postal_code
 * @property string $city
 * @property string $country
 * @property int $id_user
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            
            ['firstName', 'trim'],
            ['firstName', 'required', 'message' => 'Introduza um nome.'],
            ['firstName', 'string', 'min' => 2, 'max' => 50, 
            'tooShort' => 'O nome tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome não pode exceder os 50 digitos.'
            ],

            ['lastName', 'trim'],
            ['lastName', 'required', 'message' => 'Introduza um apelido.'],
            ['lastName', 'string', 'min' => 2, 'max' => 50, 
            'tooShort' => 'O apelido tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O apelido não pode exceder os 50 digitos.'
            ],

            ['nif', 'trim'],
            ['nif', 'integer', 'message' => 'NIF incorreto.'],
            ['nif', 'required', 'message' => 'Introduza um NIF.'],
            ['nif', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'NIF já registado.'],
            ['nif', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O NIF tem que ter 9 dígitos.', 
                'tooLong' => 'O NIF tem que ter 9 dígitos.'
            ],
            
            ['phone', 'integer', 'message' => 'Número de telefone incorreto.'],
            ['phone', 'required', 'message' => 'Introduza um número de telefone.'],
            ['phone', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O número de telefone tem que ter 9 dígitos.', 
                'tooLong' => 'O número de telefone tem que ter 9 dígitos.'
            ],

            ['address', 'trim'],
            ['address', 'required', 'message' => 'Introduza uma morada.'],
            ['address', 'string', 'min' => 2, 'max' => 255, 
            'tooShort' => 'A morada tem que ter no mínimo 2 digitos.',
            'tooLong' => 'A morada não pode exceder os 255 digitos.'
            ],

            ['postal_code', 'trim'],
            ['postal_code', 'required', 'message' => 'Introduza um código de postal.'],
            ['postal_code', 'string', 'min' => 4, 'max' => 8, 
            'tooShort' => 'O código de postal tem que ter no mínimo 4 digitos.',
            'tooLong' => 'O código de postal não pode exceder os 8 digitos.'
            ],

            ['city', 'trim'],
            ['city', 'required', 'message' => 'Introduza uma cidade.'],
            ['city', 'string', 'min' => 2, 'max' => 50, 
            'tooShort' => 'O nome da cidade tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome da cidade não pode exceder os 50 digitos.'
            ],

            ['country', 'trim'],
            ['country', 'required', 'message' => 'Introduza um país.'],
            ['country', 'string', 'min' => 2, 'max' => 100, 
            'tooShort' => 'O nome do país tem que ter no mínimo 2 digitos.',
            'tooLong' => 'O nome do país não pode exceder os 100 digitos.'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'nif' => 'Nif',
            'postal_code' => 'Postal Code',
            'city' => 'City',
            'country' => 'Country',
            'id_user' => 'Id User',
        ];
    }

    /**
       * @inheritdoc$primaryKey
       */
      public static function primaryKey()
      {
          return ["id_user"];
      }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}