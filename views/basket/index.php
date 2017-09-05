<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = "Корзина";
?>
<section class="basket">
    <table class="table table-hover">
        <thead>
        <th>Артикул</th>
        <th>Изображение</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Удалить</th>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= HTML::encode($product->article) ?></td>
                <td><?= HTML::tag('img', '', ['src' => $product->image, 'width' => 150]) ?></td>
                <td><?= HTML::encode($product->name) ?></td>
                <td><?= HTML::encode($product->price_1 * $cart[$product->id]) ?></td>
                <td><?= HTML::tag('input', '', ['min' => 1, 'value' => $cart[$product->id], 'type' => 'number', 'class' => 'form-control update-kol', 'data-id' => $product->id, 'onkeypress' => 'return false']) ?></td>
                <td><?= HTML::a('', ["basket/remove", 'id' => $product->id], ["class" => 'glyphicon glyphicon-remove']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="col-md-12">
        <div class="col-md-offset-10">
            <p class="lead">Итог <?= $itog ?> руб.</p>
            <?= HTML::a('Оформить заказ',['basket/cart'],['class'=>'btn btn-success']) ?>
        </div>
    </div>
</section>
