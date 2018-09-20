<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Nannies;
use yii\db\Query;

/**
 * NannySearch represents the model behind the search form about `common\models\Nannies`.
 */
class NannySearch extends Nannies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'address',  'email', 'position_for', 'availability'], 'string'],
            [['zip_code'], 'each', 'rule' => ['integer']]
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
     * @return ActiveDataProvider
     */
    public function search($params, $limit='')
    {
        $query = $query = Nannies::find()->where(['<>', 'status', self::STATUS_DELETED]);
        if($limit!=''){
            $query = $query->limit($limit);
        }

        if (Yii::$app->id === 'frontend') {
            $attach_condition = (new Query())
                ->select('user_id')
                ->from('user_order')
                ->where(['>', 'expired_at', time()]);
            $query = $query->andWhere(['in', 'id', $attach_condition]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->id === 'frontend' ? 9 : 20,
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['in', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'position_for', $this->position_for])
            ->andFilterWhere(['like', 'availability', $this->availability]);
        return $dataProvider;
    }
}
