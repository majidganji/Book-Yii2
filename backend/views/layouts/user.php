<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
?>
<?php $this->beginContent('@app/views/layouts/index.php'); ?>
<div class="row">
    <div class="col-sm-12">
        <?php
        NavBar::begin([
            'brandLabel' => 'کاربران',
            'brandUrl' => ['user/index'],
            'options' => [
                'class' => 'navbar navbar-default',
            ],
        ]);
        $menuItems = [
            ['label' => 'لیست کاربران', 'url' => ['/user/index']],
            ['label' => 'جستجو', 'url' => ['/user/search']],
        ];
        echo Nav::widget([
            'encodeLabels' => FALSE,
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </div>
</div>
<?= $content ?>
<?php $this->endContent(); ?>