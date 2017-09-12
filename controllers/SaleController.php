<?php

namespace app\controllers;
use Yii;
use yii\web\NotFoundHttpException;
use Yii\web\Response;
use app\models\Catalog;
use app\models\Product;
use app\models\Basket;

class SaleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $form=new Basket();
        if ($form->load(Yii::$app->request->post()) && $form->validate()){
            $form->appendBasket();
            $form->save();
        }
        if(($product_slug=Yii::$app->request->get("slug"))!=null){
            $product=Product::find()
                ->innerJoinWith('catalog')
                ->andWhere(['product.slug'=>$product_slug])->one();
            $breadcr=Catalog::findAllParent($product->id_catalog);
            if($product!=null){
                return $this->render('index',['breadcr'=>$breadcr,'model'=>$product,'form_basket'=>$form]);
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            throw new NotFoundHttpException();
        }
    }
}
