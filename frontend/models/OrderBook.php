<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "orderBook".
 *
 * @property integer $order_id
 * @property integer $book_id
 * @property integer $quantity
 * @property integer $confirmed
 *
 * @property Books $book
 * @property Orders $order
 */
class OrderBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderBook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'quantity'], 'required'],
            [['order_id', 'book_id', 'quantity', 'confirmed'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'book_id' => 'Book ID',
            'quantity' => 'Quantity',
            'confirmed' => 'Confirmed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}
