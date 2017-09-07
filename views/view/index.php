<?php

use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = $catalog_name;
?>
<?php Pjax::begin(); ?>
<div class="container">
    <h1><?= Html::encode($catalog_name) ?></h1>
    <div class="col-md-4">
        <ul class="list-group">
            <?php foreach ($catalogs as $val): ?>
                <?php if ($val->parent == 0): ?>
                    <li class="list-group-item">
                        <?= Html::a($val->name, ['/view/index', 'slug' => $val->slug], ["data-id" => $val->id, "class" => "parent"]) ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 product_view">
                    <a href="<?= Url::to(['sale/index', 'slug' => $product->slug]) ?>" target="_blank" data-pjax="0"
                       class="not_up thumbnail">
                        <?= Html::img($product->image, ['width' => 250]) ?>
                        <?= Html::a($product->name, ['/sale/index', 'slug' => $product->slug], ['target' => '_blank', 'class' => 'not_up','data-pjax'=>'0']) ?>
                        <?= Html::tag('p', "Цена от ".$product->price_4 . " руб. ", ['class' => 'price_catalog']) ?>
                        <?php $form=ActiveForm::begin(['options'=>['class'=>'form-horizontal']]);?>
                            <?= $form->field($model,'id')->input('number',['style'=>'display:none','value'=>$product->id])->label(false)?>
                            <?= $form->field($model,'count')->input('number',['min'=>1,'value'=>1])->label('Количество')?>
                            <?= Html::submitButton('В корзину',['class'=>'btn']);?>
                        <?php ActiveForm::end()?>
                    </a>

                </div>
            <?php endforeach; ?>
        </div>
        <?php echo LinkPager::widget(['pagination' => $pages]) ?>
    </div>
    <?php Pjax::end(); ?>
</div>

