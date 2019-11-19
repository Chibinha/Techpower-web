<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_item".
 *
 * @property int $id
 * @property string $unit_price
 * @property int $quantity
 * @property int $id_product
 * @property int $id_sale
 *
 * @property Product $product
 * @property Sale $sale
 */
class SaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'unit_price', 'quantity', 'id_product', 'id_sale'], 'required'],
            [['id', 'quantity', 'id_product', 'id_sale'], 'integer'],
            [['unit_price'], 'number'],
            [['id'], 'unique'],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['id_product' => 'id']],
            [['id_sale'], 'exist', 'skipOnError' => true, 'targetClass' => Sale::className(), 'targetAttribute' => ['id_sale' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'id_product' => 'Id Product',
            'id_sale' => 'Id Sale',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'id_sale']);
    }
}
