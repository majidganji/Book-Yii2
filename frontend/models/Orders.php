<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property integer $au
 * @property integer $paid
 * @property integer $amount
 * @property integer $ts
 * @property integer $confirmed
 *
 * @property OrderBook[] $orderBooks
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'book_id', 'au', 'ts'], 'required'],
            [['user_id', 'au', 'paid', 'amount', 'ts', 'confirmed'], 'integer'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'description' => 'Description',
            'au' => 'Au',
            'paid' => 'Paid',
            'amount' => 'Amount',
            'ts' => 'Ts',
            'confirmed' => 'Confirmed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook() {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
