<?php
use yii\helpers\Html;
$this->title = 'خرید کتاب';
?>
<div class="row">
    <div class="col-sm-6">
        <div class="alert alert-success">
            <h3><?= Html::encode($model->title) ?></h3>
            <hr />
            <?= nl2br($model->description) ?>
            
        </div>
        <div class="alert alert-info"><strong>قیمت:</strong> <?= $model->price ?> تومان</div>
        <?= Html::a('پرداخت آنلاین', ['/shop/gobank', 'id' => $model->id], ['class' => 'btn btn-success btn-lg']) ?>
    </div>
    <div class="col-sm-5 col-sm-offset-1">
        <img class="img-responsive" src="<?= Yii::$app->homeUrl ?>/photos/<?= $model->getImages()->one()->id ?>.jpg"/>
    </div>
</div>