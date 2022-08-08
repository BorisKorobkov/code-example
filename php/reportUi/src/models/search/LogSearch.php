<?php

namespace app\models\search;

use app\models\Log;
use app\traits\SearchTrait;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LogSearch represents the model behind the search form of `\app\models\Log`.
 */
class LogSearch extends Log
{
    use SearchTrait;

    public $startdate_from = '';
    public $startdate_to = '';

    public $enddate_from = '';
    public $enddate_to = '';

    public $client_id = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['user_id', 'each', 'rule' => ['integer']],

            [['startdate_from', 'startdate_to'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['enddate_from', 'enddate_to'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],

            ['client_id', 'each', 'rule' => ['integer']],
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
        $query = Log::find();

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
            'log.id' => $this->id,
            'log.user_id' => $this->user_id,
        ]);

        $this->searchFromTo($query, 'startdate');
        $this->searchFromTo($query, 'enddate');

        if ($this->client_id !== null) {
            $query->joinWith('user');
            $query->andFilterWhere([
                'user.client_id' => $this->client_id,
            ]);
        }

        return $dataProvider;
    }
}
