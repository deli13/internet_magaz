<?php
/**
 * Created by PhpStorm.
 * User: deli13
 * Date: 05.09.17
 * Time: 20:19
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-md-8">
        <p class="lead"></p>
    </div>
    <div class="col-md-4">
        <p class="lead text-justify">Ваш заказ на сумму <?= Html::encode($itog)?> рублей. </p>
        <?php $forms = ActiveForm::begin(); ?>
        <?= $forms->field($form, 'name')->label('Имя'); ?>
        <?= $forms->field($form, 'email')->input('email')->label('Email') ?>
        <?= $forms->field($form, 'cart')->input('hidden', ['value' => $cart])->label(false) ?>
        <?= $forms->field($form, 'phone')->input('phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999) 999 99 99'])->label('Телефон') ?>
        <?= HTML::submitButton('Заказать', ['class' => 'btn btn-primary']); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>