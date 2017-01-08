<?php

use yii\helpers\Html;
use common\components\JDF;

$this->title = Yii::$app->user->identity->username . ' حساب کاربری ';
?>
<div class="row">

    <table class="col-sm-6 table table-hover table-striped table-condensed table-responsive">
        <tr>
            <td><strong>نام:</strong></td><td><?= Html::encode(Yii::$app->user->identity->name) ?></td>
        <tr>
            <td><strong>نام خانوادگی:</strong></td><td><?= Html::encode(Yii::$app->user->identity->family) ?></td>
        </tr>
        <tr>
            <td><strong>نام کاربری:</strong></td><td><?= Html::encode(Yii::$app->user->identity->username) ?></td>
        </tr>
        <tr>
            <td><strong>ایمیل:</strong></td><td><?= Html::encode(Yii::$app->user->identity->email) ?></td>
        </tr>
        <tr>
            <td><strong>تاریخ ثبت نام:</strong></td><td><?= Html::encode(JDF::jdate('l j F Y - H:i:s', Yii::$app->user->identity->created_at)) ?></td>
        </tr>
        <tr>
            <td><strong>آخرین برروز رسانی:</strong></td><td><?= Html::encode(JDF::jdate('l j F Y - H:i:s', Yii::$app->user->identity->updated_at)) ?></td>
        </tr>
        <tr>
            <td><strong>آخرین ورود:</strong></td><td><?= Html::encode(JDF::jdate('l j F Y - H:i:s', Yii::$app->session->get('last_login_time'))) ?></td>
        </tr>
    </table>
    <div class="col-sm-4 col-sm-offset-2">
        <div class="alert alert-danger">
            <span class="fa fa-info-circle"></span> اطلاعات
            <hr />
            <p style="text-align: justify;">
                اگر تا به این زمان اطلاعات خود را بروز رسانی نکرده اید تاریخ ثبت نام نمایش داده می شود.
            </p>
        </div>
    </div>
</div>