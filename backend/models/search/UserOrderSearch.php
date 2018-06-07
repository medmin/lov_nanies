<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserOrder;

/**
 * UserOrderSearch represents the model behind the search form about `common\models\UserOrder`.
 */
class UserOrderSearch extends UserOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'service_money', 'timestamp'], 'integer'],
            [['user_type', 'payment_gateway', 'payment_gateway_id', 'service_plan'], 'safe'],
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
        $query = UserOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['timestamp' => SORT_DESC]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'service_money' => $this->service_money,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'user_type', $this->user_type])
            ->andFilterWhere(['like', 'payment_gateway', $this->payment_gateway])
            ->andFilterWhere(['like', 'payment_gateway_id', $this->payment_gateway_id])
            ->andFilterWhere(['like', 'service_plan', $this->service_plan]);

        return $dataProvider;
    }
}
