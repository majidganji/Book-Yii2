<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;
    $this->title = 'ویرایش مشخصات';
    $form = ActiveForm::begin();
?>
<div class="row">
    <div class="col-sm-5">
        
        <?= $form->field($model, 'username')->textInput(['disabled' => true]) ?>
        
        <?= $form->field($model, 'name') ?>
        
        <?= $form->field($model, 'family') ?>
        
        <?= $form->field($model, 'email')->textInput(['style' => 'direction:ltr;']) ?>
        
        <div class="form-group">
            <a class="btn btn-danger" href="<?= Url::to(['/site/accunt']) ?>">لغو</a>
            &nbsp;
            <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
        </div>
        
    </div>
    <div class="col-sm-4 col-sm-offset-2">
        <div class="alert alert-danger">
            <span class="fa fa-info-circle"></span> اطلاعات
            <hr />
            <p style="text-align:justify;">
                ایمیل خود را درست وارد کنید .
                <br />
                تمامی اطلاعات،بازیافت رمز عبور، و... به ایمیل تان ارسال خواهد شد.مسئولیت اشتباه وارد کردن ایمیل به عهده خودتان است.
            </p>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>