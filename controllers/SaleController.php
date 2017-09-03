<?php

namespace app\controllers;
use Yii;
use yii\web\NotFoundHttpException;
use Yii\web\Response;
use app\models\Catalog;
use app\models\Product;

class SaleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(($product_slug=Yii::$app->request->get("slug"))!=null){
            $product=Product::find()
                ->innerJoinWith('catalog')
                ->andWhere(['product.slug'=>$product_slug])->one();
            if($product!=null){
                return $this->render('index',['model'=>$product]);
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            throw new NotFoundHttpException();
        }

    }

}
