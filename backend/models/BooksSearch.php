<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Books;

class BooksSearch extends Books {

    public $user;
    public $category;

    public function rules() {
        return [
            [['id', 'countPage', 'price', 'ts', 'confirmed'], 'integer'],
            [['editor', 'title', 'description','category', 'user'], 'safe'],
        ];
    }


    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = Books::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['categories.name' => SORT_ASC],
            'desc' => ['categories.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $query->joinWith(['category', 'user']);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'countPage' => $this->countPage,
            'price' => $this->price,
            'ts' => $this->ts,
            'confirmed' => $this->confirmed,
        ]);

        $query->andFilterWhere(['like', 'editor', $this->editor])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'books.id', $this->id])
                ->andFilterWhere(['like', 'categories.name', $this->category])
                ->andFilterWhere(['like', 'user.name', $this->user])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
