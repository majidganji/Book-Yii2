<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">
    <h1>خطا!</h1>
    <div class="alert alert-danger">
        <h2><?= Html::encode($this->title) ?></h2>
        <hr />
        <p>
            <?= nl2br(Html::encode($message)) ?>
        </p>
        <br />
        <br />
        <a class="btn btn-danger btn-lg" href="<?= Url::to(['/site/index']) ?>">بازگشت به صفحه اصلی</a>
    </div>

</div>
