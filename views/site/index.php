<?php

/* @var $this yii\web\View */
use yii\helpers\HtmlPurifier;
$this->title = 'Пичалька компани';
?>

<div class="jumbotron">
    <h2><?=HtmlPurifier::process($text->title);?></h2>
    <p class="lead"><?=HtmlPurifier::process($text->text)?></p>
</div>

