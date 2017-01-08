<?php 
use yii\helpers\Url;
$this->beginContent('@app/views/layouts/main.php');
?>
<div class="col-sm-3">
    <div class="list-group">
        <a class="list-group-item active">
            <span class="fa fa-gear"></span> حساب کاربری
        </a>
        <a class="list-group-item" href="<?= Url::to(['/site/change-accunt']) ?>"><span class="fa fa-pencil"></span> ویرایش مشخصات</a>
        <a class="list-group-item" href="<?= Url::to(['/site/change-password']) ?>"><span class="fa fa-lock"></span> تغییر رمز عبور</a>
    </div>
</div>
<div class="col-sm-9">
    <?= $content?>
</div>
<?php $this->endContent(); ?>