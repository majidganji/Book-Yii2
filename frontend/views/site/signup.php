<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'ثبت نام';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>برای ثبت نام فرم زیرا پر کنید.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'family') ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <?=
            $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ])
            ?>

            <div class="form-group">
                <?= Html::submitButton('ثبت نام', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-3 col-lg-offset-3">
            <div class="alert alert-danger">
                <h3>اطلاعات</h3>
                <hr />
                <p>ثبت نام در سایت رایگان است.
                </p>
                <p>
                    اگر قبلا ثبت نام کرده اید می تواید <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>">وارد سایت</a> شوید.
                </p>
                <p>
                    لطفا ایمیل معتبر وارد کنید زیرا تنها راه ارتباط بین ما و شماست.
                </p>
            </div>
        </div>
    </div>
</div>
