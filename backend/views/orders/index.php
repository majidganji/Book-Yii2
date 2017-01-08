<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'فاکتورها';
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ایجاد فاکتور', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user',
                'value' => 'user.username',
                'label' => 'نام کاربری'
            ],
            [
                'attribute' => 'book',
                'label' => 'نام کتاب',
                'value' => 'book.title'
            ],
            'au',
            [
                'attribute' => 'paid',
                'value' => function ($model){
                    return $model->paid ? 'پرداخت شده' : 'پرداخت نشده';
                },
                'filter' => [1 => 'پرداخت شده', 0 => 'پرداخت نشده'],
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
