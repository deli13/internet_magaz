<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = $model->name;
foreach ($breadcr as $key=>$value){
    $this->params['breadcrumbs'][] = ['label' => $key, 'url' => ['price/' . $value]];
}
$this->params['breadcrumbs'][] = $this->title;

$max = preg_replace("/[^0-9]/", '', $model->remain);
if ($max == "") {
    $max = 100;
}
?>
<article itemscope itemtype="http://schema.org/Product">
    <div class="row">
        <div class="col-md-4">
            <a href="<?= $model->image ?>" data-fancybox='images'>
                <img src="<?= $model->image ?>" alt="<?= $model->name ?>" class="img-rounded" width="250"
                     itemprop="image"/>
            </a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-success">
                <div class="panel-heading"><h3 class="panel-title" itemprop="name"><?= $model->name ?></div>
                <p class="hidden" itemprop="description"><?= $model->name ?></p>
                <div class="panel-body" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <div class="row">
                        <div class="col-md-6"><p class="lead">Артикул</p></div>
                        <div class="col-md-6"><?= HTML::tag('p', $model->article, ['class' => 'lead']) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><p class="lead">Цена 1</p></div>
                        <div class="col-md-6"><?= HTML::tag('p', $model->price_1 . ' руб.', ['class' => 'lead']) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><p class="lead">Цена 2</p></div>
                        <div class="col-md-6"><?= HTML::tag('p', $model->price_2 . ' руб.', ['class' => 'lead']) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><p class="lead">Цена 3</p></div>
                        <div class="col-md-6"><?= HTML::tag('p', $model->price_3 . ' руб.', ['class' => 'lead']) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><p class="lead">Цена 4</p></div>
                        <div class="col-md-6"><?= HTML::tag('p', $model->price_4 . ' руб.', ['class' => 'lead', 'itemprop' => 'price']) ?></div>
                        <p class="hidden" itemprop="pricecurrency">RUB</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><p class="lead">Остаток</p></div>
                        <div class="col-md-6"><?= HTML::tag('p', $model->remain, ['class' => 'lead']) ?></div>
                    </div>
                </div>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'append']); ?>
            <?= $form->field($form_basket, 'id')->input('number', ['style' => 'display:none', 'value' => $model->id])->label('', ['style' => 'display:none']) ?>
            <?= $form->field($form_basket, 'count')->input('number', ['min' => '1', 'value' => '1','max'=>$max])->label('Количество') ?>
            <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</article>
