<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
use yii\helpers\ArrayHelper;
use backend\models\Books;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">
    
    <div class="col-sm-6">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'username'), ['size' => 5]) ?>

        <?= $form->field($model, 'book_id')->dropDownList(ArrayHelper::map(Books::find()->all(), 'id', 'title'), ['size' => 5]) ?>

        <?= $form->field($model, 'au')->textInput() ?>

        <?= $form->field($model, 'paid')->dropDownList([1 => 'پرداخت شده', 0 => 'پرداخت نشده']) ?>

        <?= $form->field($model, 'confirmed')->dropDownList([1 => 'فعال', 0 => 'غیرفعال']) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'ذخیره' : 'ویرایش', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    
</div>
