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
            [['nif', 'id_user'], 'integer'],
            [['id_user'], 'required'],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 255],
            [['postal_code'], 'string', 'max' => 8],
            [['city'], 'string', 'max' => 50],
            [['country'], 'string', 'max' => 100],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}