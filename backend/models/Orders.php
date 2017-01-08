<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $book_id
 * @property integer $au
 * @property integer $paid
 * @property integer $ts
 * @property integer $confirmed
 *
 * @property Books $book
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id'], 'required'],
            [['user_id', 'book_id', 'au', 'paid', 'ts', 'confirmed'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ردیف',
            'user_id' => 'کاربر',
            'book_id' => 'کتاب',
            'au' => 'کد بانک',
            'paid' => 'پرداخت شده/نشده',
            'ts' => 'زمان',
            'confirmed' => 'فعال/غیرفعال',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
