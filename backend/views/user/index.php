<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\JDF;
use yii\widgets\Pjax;


$this->title = 'کاربران';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label' => 'ردیف',
            ],
            [
                'attribute' => 'name',
                'label' => 'نام',
            ],
            [
                'attribute' => 'family',
                'label' => 'نام خانوادگی',
            ],
            [
                'attribute' => 'username',
                'label' => 'نام کاربری',
            ],
            [
                'attribute' => 'email',
                'label' => 'ایمیل',
                'format' => 'email',
            ],
            [
                'attribute' => 'last_login_time',
                'label' => 'آخرین ورود',
                'value' => function ($model){
                    return JDF::jdate('l j F Y - H:i:s', $model->last_login_time);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
