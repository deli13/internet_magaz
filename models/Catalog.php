<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

//use app\assets\SluggableBehavior;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property string $created_at
 * @property string $updated_at
 * @property string $slug
 *
 * @property Product[] $products
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        //return parent::behaviors(); // TODO: Change the autogenerated stub
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'name',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ]
        ];
    }

    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent' => 'Parent',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'slug' => 'Slug',
        ];
    }

    public function getParent(){
        $query=Catalog::findOne($this->parent);
        return $query->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id_catalog' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CatalogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CatalogQuery(get_called_class());
    }

    public static function findBySlug($slug){
        $catalog=Catalog::findOne(['slug'=>$slug]);
        if($catalog!==null){
            return $catalog;
        } else {
            throw new NotFoundHttpException();
        }
    }

    public static function findAllChild($id){
        $catalog=Catalog::findAll(['parent'=>$id]);
        if($catalog!==null){
            return $catalog;
        } else {
            return 0;
        }
    }

    public static function findSubChild($id){ //return array id child
        $catalogs=Catalog::findAllChild($id);
        $array_childs=[$id];
        if($catalogs) {
            foreach ($catalogs as $catalog) {
                $array_childs[] = $catalog->id;
                $cat = Catalog::findAllChild($catalog->id);
                if ($cat) {
                    foreach ($cat as $val) {
                        $array_childs[] = $val->id;
                    }
                }
            }
        }
//        } else {
//            throw new NotFoundHttpException();
//        }
        return $array_childs;
    }

    public static function findAllParent($id){
        $catalog=Catalog::findOne($id);
        $parent=$catalog->parent;
        $arr_parent=[$catalog->name=>$catalog->slug];
        while ($parent!=0){
            $find_catalog=Catalog::findOne(['id'=>$parent]);
            $arr_parent[$find_catalog->name]=$find_catalog->slug;
            $parent=$find_catalog->parent;
        }
        return array_reverse($arr_parent);
    }
}
