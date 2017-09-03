<?php
/* @var $this yii\web\View */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->catalog->name, 'url' => ['price/' . $model->catalog->slug]];
$this->params['breadcrumbs'][] = $this->title;
print_r($model);
?>
<article>
    <div class="row">524877
        <div class="col-md-4">
            <a href="<?= $model->image ?>" data-fancybox='images'>
                <img src="<?= $model->image ?>" alt="<?= $model->name ?>" class="img-rounded"/>
            </a>
        </div>
        <div class="col-md-8">

        </div>
    </div>
</article>
