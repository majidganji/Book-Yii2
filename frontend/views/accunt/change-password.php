<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'تغییر رمز عبور';
?>
<div class="row">
    <div class="col-sm-5">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'old_password')->passwordInput() ?>
        
        <?= $form->field($model, 'password')->passwordInput() ?>
        
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        
        <div class="form-group">
            <a class="btn btn-danger" href="<?= Url::to(['/site/accunt']) ?>">لغو</a>
            &nbsp;
            <?= Html::submitButton('تغییر رمز عبور', ['class' => 'btn btn-success']) ?>
        </div>
        

        <?php ActiveForm::end(); ?>
    </div>
</div>