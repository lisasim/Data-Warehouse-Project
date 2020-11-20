<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LogHistory;

/**
 * LogHistorySearch represents the model behind the search form of `app\models\LogHistory`.
 */
class LogHistorySearch extends LogHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang', 'username', 'waktu', 'aktivitas'], 'safe'],
            [['jumlah', 'id'], 'integer'],
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
        $query = LogHistory::find();

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
            'waktu' => $this->waktu,
            'jumlah' => $this->jumlah,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'kode_barang', $this->kode_barang])
            ->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'aktivitas', $this->aktivitas]);

        return $dataProvider;
    }
}
