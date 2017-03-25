<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public $price1;
    public $price2;
    public $size;
    public $type;
    public $material;
    public $flowing;
    public $technique;
    public $artist;
    public function rules()
    {
        return [
            [['id', 'artist_id', 'category_id', 'technique_id', 'material_id', 'flowing_id','type'], 'integer'],
            [['creation_date', 'description', 'product_date', 'support','title','price1','price2','size','material','flowing','technique','artist'], 'safe'],
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
    public function attributeLabels()
    {
        return [
            'price1' => 'Desde',
            'price2' => 'Hasta',
            'size' => 'Tamaño',
            'type' => 'Tipo',
    
        ];
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$category_param=NULL)
    {
        $query = Product::find()->joinWith(['mesuretypes','artist','technique','material','flowing']);

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
            'artist_id' => $this->artist_id,
            'category_id' => $this->category_id,
            'creation_date' => $this->creation_date,
            'product_date' => $this->product_date,
            'technique_id' => $this->technique_id,
            'material_id' => $this->material_id,
            'flowing_id' => $this->flowing_id,
            'size' => $this->size,
            'type_id' => $this->type,
        ]);
        if($category_param){
          $query->andFilterWhere(['category_id' => $category_param]);
        }
        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'support', $this->support])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'technique.description', $this->technique])
            ->andFilterWhere(['like', 'artist.name', $this->artist])
            ->andFilterWhere(['like', 'material.description', $this->material])
            ->andFilterWhere(['like', 'flowing.description', $this->flowing])
            ->andFilterWhere(['between', 'price', $this->price1,$this->price2]);

        return $dataProvider;
    }
}
