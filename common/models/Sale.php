<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $sale_date
 * @property string $total_amount
 * @property bool $sale_finished
 *
 * @property SaleItem[] $saleItems
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_date'], 'safe'],
            [['total_amount'], 'required'],
            [['total_amount'], 'number'],
            [['sale_finished'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_date:datetime' => 'Sale Date',
            'total_amount' => 'Total Amount',
            'sale_finished' => 'Sale Finished',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['id_sale' => 'id']);
    }
}
