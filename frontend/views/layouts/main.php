<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\components\JDF;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">

            <img src="<?= Yii::$app->homeUrl ?>/image/1.jpg" style="height: 250px; width: 100%;" >
            <?php
            NavBar::begin([
                'brandLabel' => '<span class="fa fa-book"></span> ' . 'کتاب',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-default',
                ],
            ]);
            $menuItems = [
                ['label' => '<span class="fa fa-home"></span> ' . 'صفحه اصلی', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => '<span class="fa fa-sign-in"></span> ' . 'ورود', 'url' => ['/site/login']];
                $menuItems[] = ['label' => '<span class="fa fa-user"></span> ' . 'ثبت نام', 'url' => ['/site/signup']];
            } else {
                $menuItems[] = ['label' => '<span class="fa fa-gear"></span> ' . 'حساب کاربری', 'url' => ['/site/accunt']];
                $menuItems[] = [
                    'label' => '<span class="fa fa-sign-out"></span>' . ' خروج  ( ' . Yii::$app->user->identity->username . ' )',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            $menuItems[] = ['label' => '<span class="fa fa-street-view "></span> ' . 'درباره ما', 'url' => ['/site/about']];
            $menuItems[] = ['label' => '<span class="fa fa-phone"></span> ' . 'تماس با ما', 'url' => ['/site/contact']];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'encodeLabels' => false,
            ]);
            NavBar::end();
            ?>
            <div class="container">
                <div class="col-sm-12 conntent-main">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; دانلود کتاب <?= JDF::jdate('Y') ?></p>
                <p class="pull-right">تمام حقوق محفوظ بوده و استفاده از مطالب سایت با ذکر منبع بلامانع است.</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
