<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'تماس با ما';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        اگر شما سوالات کسب و کار و یا سوالات دیگری دارید، لطفا با پر کردن فرم زیر با ما تماس بگیرید. تشکر.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->label('نام و نام خانوادگی') ?>

                <?= $form->field($model, 'email')->label('ایمیل') ?>

                <?= $form->field($model, 'subject')->label('موضوع') ?>

                <?= $form->field($model, 'body')->textArea(['rows' => 6])->label('متن') ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])->label('کد امنیتی') ?>

                <div class="form-group">
                <?= Html::submitButton('ارسال', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-3 col-lg-offset-3">
            <div class="alert alert-danger">
                <h3><span class="fa fa-info-circle"></span> اطلاعات</h3>
                <hr />
                <p style="text-align: justify;">
                    در اولین فرصت به پیام شما جواب داده خواهد شد. پس از ارسال مجدد پیام خود داری کنید.
                </p>
                <p style="text-align: justify;">
                    آدرس ایمیل معتبر وارد کنید زیرا جواب پیام شما به ایمیل وارد شده ارسال خواهد شد.
                </p>
            </div>
        </div>
    </div>

</div>
