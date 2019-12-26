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
            [['product_name'], 'string', 'max' => 150],
            [['description'], 'string'],
            [['product_image'], 'file', 'extensions' => 'jpeg,jpg,png'],
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
            'id_category' => 'Category',
            'product_image' => 'Product Image',
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

    public function publish($channel, $msg)
    {
        try {
            $server = "127.0.0.1";
            $port = 1883;
            $username = "";
            $password = "";
            $clientId = "phpMQTT-publisher";
            $mqtt = new \app\mosquito\phpMQTT($server, $port, $clientId);
            if ($mqtt->connect(true, null, $username, $password)) {
                $mqtt->publish($channel, $msg, 0);
                $mqtt->close();
            } else {
                file_put_contents("debug.output", "Time out!");
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $msg = new \stdClass();
        $msg->id = $this->id;
        $msg->product_name = $this->product_name;
        $jsonMsg = json_encode($msg);

        if ($insert) {
            $this->publish("INSERT", $jsonMsg);
        } else {
            $this->publish("UPDATE", $jsonMsg);
        }
    }
}
