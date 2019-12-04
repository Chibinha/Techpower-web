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
            [['firstName'], 'string', 'max' => 50],
            [['lastName'], 'string', 'max' => 50],
            [['id_user'], 'integer'],
            [['nif'], 'integer', 'message' => 'NIF incorreto.'],
            [['id_user'], 'required'],
            [['address'], 'string', 'max' => 255],
            [['postal_code'], 'string', 'max' => 8],
            [['city'], 'string', 'max' => 50],
            [['country'], 'string', 'max' => 100],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            
            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'string', 'min' => 9, 'max' => 9, 
                'tooShort' => 'O NIF tem que ter 9 dígitos.', 
                'tooLong' => 'O NIF tem que ter 9 dígitos.'
            ],
            ['nif', 'unique', 'targetClass' => '\common\models\Profile', 'message' => 'NIF já registado.'],
            
            ['phone', 'integer', 'message' => 'Número de telefone incorreto.'],
            ['phone', 'string', 'min' => 9, 'max' => 20, 
                'tooLong' => 'O número de telefone não pode ter mais do que 20 dígitos.',
                'tooShort' => 'O número de telefone tem que ter no mínimo 9 dígitos.' 
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