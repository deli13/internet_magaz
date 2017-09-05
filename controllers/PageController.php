<?php

namespace app\controllers;
use Yii;
use yii\web\NotFoundHttpException;
use Yii\web\Response;
use app\models\Post;

class PageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(($page_slug=Yii::$app->request->get("slug"))!=null){
            $page=Post::findOne(['slug'=>$page_slug]);
            if ($page!=null){
                return $this->render('index',['text'=>$page]);
            } else {
                throw new NotFoundHttpException();
            }
        } else {
            throw new NotFoundHttpException();
        }

    }
}
