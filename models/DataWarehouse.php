<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_warehouse".
 *
 * @property string $kode_barang
 * @property string|null $nama_item
 * @property string|null $satuan_pengeluaran
 * @property string|null $satuan_pembelian
 * @property float|null $harga
 * @property string|null $pembelian_by
 * @property string|null $vendor
 * @property int|null $stok
 * @property string|null $koordinat
 * @property int|null $konverter
 * @property string|null $jumlah_per_pcs
 */
class DataWarehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse.data_warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang','nama_item', 'satuan_pengeluaran', 'satuan_pembelian', 'harga', 'pembelian_by', 'vendor', 'konverter'], 'required'],
            [['kode_barang', 'nama_item', 'satuan_pengeluaran', 'satuan_pembelian', 'pembelian_by', 'vendor', 'koordinat', 'jumlah_per_pcs'], 'string'],
            [['harga'], 'number'],
            [['stok', 'konverter'], 'default', 'value' => null],
            [['stok', 'konverter'], 'integer'],
            [['kode_barang'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_barang' => 'Kode Barang',
            'nama_item' => 'Nama Item',
            'satuan_pengeluaran' => 'Satuan Pengeluaran',
            'satuan_pembelian' => 'Satuan Pembelian',
            'harga' => 'Harga',
            'pembelian_by' => 'Pembelian By',
            'vendor' => 'Vendor',
            'stok' => 'Stok',
            'koordinat' => 'Koordinat',
            'konverter' => 'Konverter',
            'jumlah_per_pcs' => 'Jumlah Per Pcs',
        ];
    }
}
