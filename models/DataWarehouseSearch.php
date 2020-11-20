<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataWarehouse;

/**
 * DataWarehouseSearch represents the model behind the search form of `app\models\DataWarehouse`.
 */
class DataWarehouseSearch extends DataWarehouse
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang', 'nama_item', 'satuan_pengeluaran', 'satuan_pembelian', 'pembelian_by', 'vendor', 'koordinat', 'jumlah_per_pcs'], 'safe'],
            [['harga'], 'number'],
            [['stok', 'konverter'], 'integer'],
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
        $query = DataWarehouse::find();

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
            'harga' => $this->harga,
            'stok' => $this->stok,
            'konverter' => $this->konverter,
        ]);

        $query->andFilterWhere(['ilike', 'kode_barang', $this->kode_barang])
            ->andFilterWhere(['ilike', 'nama_item', $this->nama_item])
            ->andFilterWhere(['ilike', 'satuan_pengeluaran', $this->satuan_pengeluaran])
            ->andFilterWhere(['ilike', 'satuan_pembelian', $this->satuan_pembelian])
            ->andFilterWhere(['ilike', 'pembelian_by', $this->pembelian_by])
            ->andFilterWhere(['ilike', 'vendor', $this->vendor])
            ->andFilterWhere(['ilike', 'koordinat', $this->koordinat])
            ->andFilterWhere(['ilike', 'jumlah_per_pcs', $this->jumlah_per_pcs]);

        return $dataProvider;
    }
}
