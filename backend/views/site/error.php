<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <div class="alert alert-danger">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr />  
        <?= nl2br(Html::encode($message)) ?>
    <br />
    <br />
    <p>
        <?= Html::a('بازگشت به صفحه اصلی', ['/site/index'],['class' => 'btn btn-danger btn-lg']) ?>
    </p>
    </div>


</div>
