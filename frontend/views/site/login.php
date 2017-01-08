<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'ورود';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>لطفا فرم زیر را پر کنید .</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    اگر رمز عبور خود را فراموش کرده اید <?= Html::a('اینجا کلیک کنید', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-3 col-lg-offset-3">
            <div class="alert alert-danger">
                <h3>اطلاعات</h3>
                <hr />
                <p>
                    برای ورود ابتدا باید <a href="<?= Url::to(['/site/signup']); ?>">ثبت نام </a> کنید.
                </p>
            </div>
        </div>
    </div>
</div>
