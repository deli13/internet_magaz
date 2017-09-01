<?php

use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
?>
<h1>Каталог</h1>
<?php Pjax::begin();?>
<div class="container">
    <div class="col-md-4">
        <ul class="list-group">
            <?php foreach ($catalogs as $val): ?>
                <?php if ($val->parent == 0): ?>
                    <li class="list-group-item">
                        <?= Html::a($val->name, ['/view/index','slug'=>$val->slug],["data-id"=>$val->id, "class"=>"parent"]) ?>
<!--                    --><?php //if($val->id==$parent):?>
<!--                        <ul class="hid">-->
<!---->
<!--                        </ul>-->
<!--                        --><?//endif;?>

                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-8">
        <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <a href="#" class="thumbnail">
                <?= Html::img($product->image)?>
                <?= Html::a($product->name,['sale/item','slug'=>$product->slug])?>
                </a>

            </div>
        <?php endforeach; ?>
        </div>
        <?php echo LinkPager::widget(['pagination' => $pages]) ?>
    </div>
<?php Pjax::end();?>
</div>

