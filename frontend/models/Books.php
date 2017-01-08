<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property string $editor
 * @property string $title
 * @property string $description
 * @property integer $countPage
 * @property integer $price
 * @property integer $ts
 * @property integer $confirmed
 *
 * @property Categories $category
 * @property User $user
 * @property BooksDow[] $booksDows
 * @property Image[] $images
 * @property Orders[] $orders
 */
class Books extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'editor', 'title', 'description', 'countPage', 'ts'], 'required'],
            [['category_id', 'user_id', 'countPage', 'price', 'ts', 'confirmed'], 'integer'],
            [['description'], 'string'],
            [['editor', 'title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'editor' => 'Editor',
            'title' => 'Title',
            'description' => 'Description',
            'countPage' => 'Count Page',
            'price' => 'Price',
            'ts' => 'Ts',
            'confirmed' => 'Confirmed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksDows() {
        return $this->hasMany(BooksDow::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages() {
        return $this->hasMany(Image::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders() {
        return $this->hasMany(Orders::className(), ['book_id' => 'id']);
    }
    
    public function getBuy() {
        $order = Orders::findOne(['book_id' => $this->id]);
        return ($order !== NULL? $order->user_id : NULL);
    }

}
