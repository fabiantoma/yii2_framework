<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transport;

/**
 * TransportSearch represents the model behind the search form of `app\models\Transport`.
 */
class TransportSearch extends Transport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'on_way', 'transport_trucks_id'], 'integer'],
            [['cargo_type', 'date'], 'safe'],
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
        $query = Transport::find();

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
            'date' => $this->date,
            'on_way' => $this->on_way,
            'transport_trucks_id' => $this->transport_trucks_id,
        ]);

        $query->andFilterWhere(['like', 'cargo_type', $this->cargo_type]);

        return $dataProvider;
    }
}
