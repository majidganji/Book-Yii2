<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\JDF;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'آیا حذف شود؟',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user.username',
            ],
            [
                'attribute' => 'book.title',
                'label' => 'کتاب',
            ],
            'au',
            [
                'attribute' =>'paid',
                'value' => ($model->paid ? 'پرداخت شده' : 'پرداخت نشده'),
                
            ],
            [
                'attribute' => 'ts',
                'value' => JDF::jdate('l j F Y - H:i:s', $model->ts)
            ],
            [
                'attribute' => 'confirmed',
                'value' => $model->confirmed ? 'فعال' : 'غیرفعال'
            ],
        ],
    ]) ?>

</div>
