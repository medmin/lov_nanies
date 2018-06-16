<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParentPost;

/**
 * ParentPostSearch represents the model behind the search form about `common\models\ParentPost`.
 */
class ParentPostSearch extends ParentPost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'zip_code', 'status', 'created_at', 'expired_at'], 'integer'],
            [['job_type', 'type_of_help', 'description'], 'safe'],
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
        $query = ParentPost::find();

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
            'user_id' => $this->user_id,
            'zip_code' => $this->zip_code,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'expired_at' => $this->expired_at,
        ]);

        $query->andFilterWhere(['like', 'job_type', $this->job_type])
            ->andFilterWhere(['like', 'type_of_help', $this->type_of_help])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
