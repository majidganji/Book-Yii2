<?php 
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="col-sm-3">
    <div class="list-group">
        <a class="list-group-item active">مدیریت</a>
        <a class="list-group-item" href="<?= Url::to(['/user/index']) ?>">کاربران</a>
        <a class="list-group-item" href="<?= Url::to(['/category/index']) ?>">دسته بندی</a>
        <a class="list-group-item" href="<?= Url::to(['/book/index']) ?>">کتاب</a>
        <a class="list-group-item" href="<?= Url::to(['/orders/index']) ?>">فاکتورها</a>
    </div>
</div>
<div class="col-sm-9">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>