<?php
//use Yii;
/**
 * Created by PhpStorm.
 * User: deli13
 * Date: 03.09.17
 * Time: 23:40
 */
$count=0;
if (Yii::$app->session->isActive){
    $count=count(Yii::$app->session->get('basket'));
}
?>

    <div class="row">

            <!--<div class="col-md-10">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control"/>
                    </div>
                </form>
            </div>-->
            <div class="col-md-offset-10">
                <ul class="nav nav-pills nav-stacked">
                    <li class="">
                        <a href="/basket/index">
                            <span style="font-size: 1.5em" class="glyphicon glyphicon-shopping-cart"></span>
                            <span>Корзина</span>
                            <span style="font-size: 1em;margin-bottom: 10px" class="badge"><?=$count?></span>
                        </a>
                    </li>
                </ul>
            </div>

    </div>
