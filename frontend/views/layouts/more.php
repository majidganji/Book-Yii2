<?php

use frontend\models\Categories;
use yii\helpers\Url;
use frontend\models\Books;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->beginContent('@app/views/layouts/main.php');
?>
<div class="col-sm-3">
        <div class="list-group">
        <a class="list-group-item active">جستجو ...</a>
        <?php
        $from = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'list-group-item'],
                    'method' => 'get',
                    'action' => ['site/search'],
        ]);
        ?>
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="fa fa-search"></span></span>
            <input type="text" class="form-control" placeholder="جستجو ..." aria-describedby="basic-addon1">
        </div>
        <br />
        <?= Html::submitButton('جستجو', ['class' => 'btn btn-default']); ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="list-group">
        <a href="#" class="list-group-item active">دسته بندی</a>
        <?php foreach (Categories::find()->where(['confimed' => 1])->all() as $model): ?>
            <a href="<?= Url::to(['site/category', 'id' => $model->id, 'name' => $model->name]) ?>" 
               class="list-group-item"><?= $model->name ?></a>
           <?php endforeach; ?>
    </div>
</div>
<div class="col-sm-9">
    <?= $content ?>
</div>

<?php $this->endContent(); ?>
