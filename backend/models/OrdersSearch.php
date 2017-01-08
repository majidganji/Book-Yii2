<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `backend\models\Orders`.
 */
class OrdersSearch extends Orders {
    
    public $user;
    public $book;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'au', 'paid', 'ts', 'confirmed'], 'integer'],
            [['book', 'user'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Orders::find();
        $query->joinWith(['user', 'book']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['book'] = [
            'asc' => ['books.title' => SORT_ASC],
            'desc' => ['books.title' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'au' => $this->au,
            'paid' => $this->paid,
            'ts' => $this->ts,
            'confirmed' => $this->confirmed,
        ]);
        $query->andFilterWhere(['like', 'user.username', $this->user])
                ->andFilterWhere(['orders.id' => $this->id])
                ->andFilterWhere(['like', 'books.title', $this->book]);

        return $dataProvider;
    }

}
