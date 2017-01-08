<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'ویرایش کاربر: ' . ' ' . $model->name;
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-sm-5">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>

</div>
