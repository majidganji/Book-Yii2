<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\JDF;
/* @var $this yii\web\View */
/* @var $model backend\models\Books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'آیاحذف شود ؟',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category.name',
                'label' => 'دسته بندی'
            ],
            'user.username',
            'editor',
            'title',
            'description:ntext',
            'countPage',
            'price',
            [
                'attribute' => 'ts',
                'value' => JDF::jdate('l j F Y - H:i:s'),
            ],
            [
                'attribute' => 'confirmed',
                'value' => $model->confirmed ? 'فعال' : 'غیرفعال',
            ],
            [
                'label' => 'تصویر',
                'format' => 'url',
                'value' => 'http://localhost/book/photos/'. $model->imageid .'.jpg',
            ],
            [
                'label' => 'کتاب',
                'format' => 'url',
                'value' => 'http://localhost/book/admin/book/download?id='. $model->id,
            ],
        ],
    ]) ?>

</div>
