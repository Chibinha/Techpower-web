<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $product_name
 * @property string $unit_price
 * @property bool $is_discontinued
 * @property string $description
 * @property int $id_category
 *
 * @property Category $category
 * @property SaleItem[] $saleItems
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'description', 'id_category'], 'required'],
            [['unit_price'], 'number'],
            [['is_discontinued'], 'boolean'],
            [['id_category'], 'integer'],
            [['product_name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 5000],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'unit_price' => 'Unit Price',
            'is_discontinued' => 'Is Discontinued',
            'description' => 'Description',
            'id_category' => 'Id Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['id_product' => 'id']);
    }
}
