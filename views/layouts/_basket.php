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
        <div class="col-md-12">
            <div class="navbar-right">
                <ul class="nav nav-pills nav-stacked">
                    <li class="">
                        <a href="#">
                            <span style="font-size: 1.5em" class="glyphicon glyphicon-shopping-cart"></span>
                            <span style="font-size: 1em;margin-bottom: 10px" class="badge"><?=$count?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
