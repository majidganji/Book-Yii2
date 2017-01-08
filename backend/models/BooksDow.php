<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "booksDow".
 *
 * @property integer $book_id
 * @property string $name
 * @property string $randname
 *
 * @property Books $book
 */
class BooksDow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booksDow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'name', 'randname'], 'required'],
            [['book_id'], 'integer'],
            [['name', 'randname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'name' => 'Name',
            'randname' => 'Randname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }
}
