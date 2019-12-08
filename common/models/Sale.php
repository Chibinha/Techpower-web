<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $sale_date
 * @property bool $sale_finished
 * @property int $id_user
 *
 * @property User $user
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
            [['id_user'], 'required'],
            [['sale_finished'], 'boolean'],
            [['id_user'], 'integer'],
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
            'sale_date' => 'Sale Date',
            'sale_finished' => 'Sale Finished',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['id_sale' => 'id']);
    }

    
    public function getSaleState($order){
        if ($order['sale_finished'] == 1){
            echo"Encomenda expedida";
        }
        else{
            echo "A preparar encomenda";
        }
    }

    public static function calcTotalSale($sale_item){
        $subTotal = $sale_item['unit_price'] * $sale_item['quantity'];
        return $subTotal;
    }

    public function getTotal()
    {
        $sale_items = SaleItem::find()->where(['id_sale' => $this->id])->all();
        $total = 0;
        foreach ($sale_items as $item) {
            $total += ($item->unit_price * $item->quantity);
        }
            return $total;
    }

    public function getSaleStateVenda(){
        $sale = Sale::find()->where(['id' => $this->id])->asArray()->one();
        
      
        if ($sale["sale_finished"] == "1"){
            return "Encomenda expedida";
        }
        else{
            return "A preparar encomenda";
        }
    }

    public function DeleteSaleItems()
    {
        $sale_items = SaleItem::find()->where(['id_sale' => $this->id])->all();
        foreach ($sale_items as $item) {
           $item->deleteInternal();
        }
    }
}
