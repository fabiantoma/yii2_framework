<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trucks;

/**
 * TrucksSearch represents the model behind the search form of `app\models\Trucks`.
 */
class TrucksSearch extends Trucks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trucks_firms_id'], 'integer'],
            [['type', 'platenumber', 'fuel_type'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Trucks::find();

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
            'trucks_firms_id' => $this->trucks_firms_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'platenumber', $this->platenumber])
            ->andFilterWhere(['like', 'fuel_type', $this->fuel_type]);

        return $dataProvider;
    }
}
