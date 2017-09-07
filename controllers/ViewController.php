<?php

namespace app\controllers;
use app\models\Catalog;
use app\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii;
use yii\web\Response;
use app\models\Basket;

class ViewController extends \yii\web\Controller
{
    public function actionIndex(){
        $form=new Basket();
        if ($form->load(Yii::$app->request->post()) && $form->validate()){
            $form->appendBasket();
            $form->save();
        }
        $child_catalogs=[];
        $par_id=0;
        $catalog_name="Каталог";
        if(($parent_slug=Yii::$app->request->get("slug"))!=null){
            $parent=Catalog::findOne(["slug"=>$parent_slug]);
            if (!is_object($parent)){
                throw new NotFoundHttpException();
            }
            $child_catalogs=Catalog::findSubChild($parent->id);
            $par_id=$parent->id;
            $catalog_name=$parent->name;
            $productAll=Product::find()->where(['in','id_catalog',$child_catalogs]);
        } else {
            $productAll=Product::find();
        }
        $catalog=Catalog::find()->all();
        $countProduct=clone $productAll;
        $pages=new Pagination(["totalCount"=>$countProduct->count()]);
        $models=$productAll->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',[
            'catalogs'=>$catalog,
            "products"=>$models,
            "pages"=>$pages,
            "child"=>$child_catalogs,
            "parent"=>$par_id,
            'catalog_name'=>$catalog_name,
            'model'=>$form
            ]);
    }

    public function actionCatalog($slug){
        $catalog=Catalog::findBySlug($slug);
        $catalogs=Catalog::findAllChild($catalog->id);
        return $this->render("catalog",['catalogs'=>$catalogs]);
    }

    public function actionParent(){ //Вывод дочерних элементов
        if(Yii::$app->request->isAjax){
            $data=Yii::$app->request->post("id");
            $child_nodes=Catalog::findAllChild($data);
            $child=[];
            foreach ($child_nodes as $nodes){
                $child[]=["id"=>$nodes->id, "name"=>$nodes->name,"slug"=>$nodes->slug];
            }
            Yii::$app->response->format=Response::FORMAT_JSON;
            return ['child'=>$child];
        }
    }

}
