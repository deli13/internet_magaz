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
                <td><?= $product->article ?></td>
                <td><?= HTML::tag('img', '', ['src' => $product->image, 'width' => 150]) ?></td>
                <td><?= $product->name ?></td>
                <td><?= $product->price_4 ?></td>
                <td><?= HTML::tag('input', '', ['min' => 1, 'value' => $cart[$product->id], 'type' => 'number', 'class' => 'form-control update-kol', 'data-id' => $product->id,'onkeypress'=>'return false']) ?></td>
                <td><?= HTML::a('', ["basket/remove", 'id' => $product->id], ["class" => 'glyphicon glyphicon-remove']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
