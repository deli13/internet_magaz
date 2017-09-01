<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article', 'id_catalog'], 'integer'],
            [['name', 'remain', 'created_at', 'updated_at', 'image', 'slug'], 'safe'],
            [['price_roznica', 'price_1', 'price_2', 'price_3', 'price_4'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article' => $this->article,
            'price_roznica' => $this->price_roznica,
            'price_1' => $this->price_1,
            'price_2' => $this->price_2,
            'price_3' => $this->price_3,
            'price_4' => $this->price_4,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id_catalog' => $this->id_catalog,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'remain', $this->remain])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
