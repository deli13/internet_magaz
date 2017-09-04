<?php

namespace app\controllers;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\Product;
use app\models\Basket;

class BasketController extends \yii\web\Controller
{
//    public function beforeAction($action)
//    {
//        return parent::beforeAction($action); // TODO: Change the autogenerated stub
//    }

    public function actionIndex()
    {
        $basket=new Basket();
        $products=$basket->findAll();
        $cart=$basket->getBasket();
        return $this->render('index',['products'=>$products, 'cart'=>$cart]);
    }

    public function actionRemove(){
        if(is_numeric($id=Yii::$app->request->get("id"))){
            $basket=new Basket();
            $basket->removeBasket($id);
            return $this->redirect(['basket/index']);
        } else{
            throw new NotFoundHttpException();
        }
    }
    public function actionUpdate(){
        $id=Yii::$app->request->get('id');
        $val=Yii::$app->request->get('val');
        if (is_numeric($id) && is_numeric($val)){
            $basket=new Basket();
            $update=$basket->updateBasket($id,$val);
        } else {
            throw new NotFoundHttpException();
        }
    }

}