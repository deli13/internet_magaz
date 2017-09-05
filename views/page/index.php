<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
$this->title=$text->title;
?>
<h1><?= Html::encode($text->title)?></h1>

<p>
<?= HtmlPurifier::process($text->text)?>
</p>
