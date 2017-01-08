<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Orders;

$this->title = $model->title ? : 'دانلود کتاب';
?>
<div class="row">
    <div class="col-sm-7">
        <h2 class="well well-sm">
            <?= Html::encode($model->title); ?>
        </h2>
        <p style="text-align: justify;"><?= nl2br($model->description) ?></p>
    </div>
    <img class="col-sm-5 img-rounded img-thumbnail img-responsive"  src="<?= Yii::$app->homeUrl ?>/photos/<?= $model->getImages()->where(['ismain' => 1])->one()->id ?>.jpg" />
</div>
<div class="row">
    <?php if ($model->price): ?>
        <p>
            <strong>قیمت: </strong> <?= Html::encode($model->price) ?> تومان
        </p>
    <?php endif; ?>
    <?php if ($model->price === NULL || $model->buy !== NULL && $model->buy === Yii::$app->user->id): ?>
        <a class="btn btn-success" href="<?= Url::to(['/site/download', 'id' => $model->id]) ?>" target="_blanck">دانلود </a>
    <?php else: ?>

        <?php if (Yii::$app->user->isGuest): ?>
            <p style="text-align: justify;" class="alert alert-danger">
                <strong>اخطار : </strong>
                برای حفظ لینک دانلود قبل از خرید  
                <a href=" <?= Url::to(['/site/login']) ?>">وارد حساب کاربری</a> خودتان شوید.
            </p>
        <?php endif; ?>
        <a class="btn btn-success" href="<?= Url::to(['/shop/shop', 'id' => $model->id]) ?>">خرید</a>
    <?php endif; ?>
</div>