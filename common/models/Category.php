<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $description
 * @property int $parent_id
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['parent_id'], 'integer'],
            [['description'], 'string', 'max' => 200],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'parent_id' => 'Parent ID',
        ];
    }

    public function getChildren()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getParentName()
    {
        if ($this->parent_id != null){
        return Category::find()->where(['id' => $this->parent_id])->One()->description;
        }
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id_category' => 'id']);
    }

    public static function getProductsByCategories($id)
    {
        //Vai buscar todas as sub-categorias com o id da categoria principal
        $cat_ids = Category::find()->select('id')->where(['parent_id' => $id])->asArray()->all();
        $ids = [];
        foreach($cat_ids as $value)
        {
            $ids[] = $value['id'];
        }

        $ids = implode(',',$ids);

        if ($ids != null)
        {
            //Se for uma categoria
            return Product::find()->where('id_category IN ('.$ids.','.$id.')');
        }
        else
        {
            //Se for uma sub-categoria
            $ids = 0;
            return Product::find()->where('id_category IN ('.$ids.','.$id.')');
        }        
    }
}
