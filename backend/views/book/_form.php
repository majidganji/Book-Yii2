<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categories;
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Categories::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style' => 'resize:none;']) ?>
    
    <?= $form->field($model, 'pdf')->fileInput() ?>
    
    <?= $form->field($model, 'img')->fileInput() ?>
    

    <?= $form->field($model, 'countPage')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>


    <?= $form->field($model, 'confirmed')->dropDownList([1 => 'فعال', 0 => 'غیرفعال']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'ایجاد' : 'ویرایش', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
