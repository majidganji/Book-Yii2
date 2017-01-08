<?php 
$this->title = 'دانلود کتاب';
use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\components\JDF;
use yii\widgets\Pjax;
use yii\helpers\Url;
?>
<?php if(!$models): ?>
    <div class="alert alert-danger">
        <p>کتاب موجود نیست.</p>
    </div>
<?php else: ?>
<?php Pjax::begin(); ?>
    <?php foreach ($models as $model): ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="<?= Url::to(['/site/more', 'id' => $model->id, 'name' => $model->title]) ?>" style="color: #fff;text-decoration: none;" ><?= Html::encode($model->title); ?></a>
            </div>
            <div class="panel-body">
                <div class="col-sm-8">
                    <?= ($model->description); ?>
                </div>
                <div class="com-sm-3">
                    <img src="<?= Yii::$app->homeUrl ?>/frontend/web/photos/<?= $model->getImages()->where(['ismain' => 1])->one()->id ?>.jpg" class="img-thumbnail"
                        style="width: 160px; height: 100px;" />
                </div>
            </div>
            <div class="panel-footer">
                <div class="text-muted">
                    <?= JDF::jdate('l j F Y - H:i:s', $model->ts) ?>
                    <div class="pull-left">
                        <?= Html::a('ادامه مطلب',['/site/more', 'id' => $model->id, 'name' => $model->title], ['class' => 'btn btn-default btn-xs']); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
<?= 
    LinkPager::widget([
        'pagination' => $pages,
    ]);
?>
<?php Pjax::end(); ?>
<?php endif; ?>