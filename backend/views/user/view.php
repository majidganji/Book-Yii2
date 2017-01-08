<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\JDF;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'آیا از حذف این اطمینان دارید ؟',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'label' => ' نام خانوادگی',
            ],
            [
                'attribute' => 'username',
                'label' => ' نام کاربری',
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'label' => ' ایمیل',
            ],
            [
                'attribute' => 'status',
                'label' => 'وضعیت',
                'value' => $model->status === 10 ? 'فعال' : 'غیر فعال' ,
            ],
            [
                'attribute' => 'last_login_time',
                'label' => 'آخرین ورود',
                'value' => JDF::jdate('l j F Y - H:i:s', $model->last_login_time),
            ],
            [
                'attribute' => 'created_at',
                'label' => 'زمان ثبت نام',
                'value' => JDF::jdate('l j F Y - H:i:s', $model->created_at),
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'آخرین بروز رسانی',
                'value' => JDF::jdate('l j F Y - H:i:s', $model->updated_at),
            ],
        ],
    ]) ?>

</div>
