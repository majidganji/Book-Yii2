<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Books */

$this->title = 'درج کتاب';
?>
<div class="books-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-sm-6">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
