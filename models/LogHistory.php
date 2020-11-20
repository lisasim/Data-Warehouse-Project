<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_history".
 *
 * @property string $kode_barang
 * @property string $username
 * @property string $waktu
 * @property int|null $jumlah
 * @property int $id
 * @property string|null $aktivitas
 *
 * @property DataWarehouse $kodeBarang
 */
class LogHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_barang', 'username', 'waktu', 'id'], 'required'],
            [['kode_barang', 'username', 'aktivitas'], 'string'],
            [['waktu'], 'safe'],
            [['jumlah', 'id'], 'default', 'value' => null],
            [['jumlah', 'id'], 'integer'],
            [['id'], 'unique'],
            [['kode_barang'], 'exist', 'skipOnError' => true, 'targetClass' => DataWarehouse::className(), 'targetAttribute' => ['kode_barang' => 'kode_barang']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_barang' => 'Kode Barang',
            'username' => 'Username',
            'waktu' => 'Waktu',
            'jumlah' => 'Jumlah',
            'id' => 'ID',
            'aktivitas' => 'Aktivitas',
        ];
    }

    /**
     * Gets query for [[KodeBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKodeBarang()
    {
        return $this->hasOne(DataWarehouse::className(), ['kode_barang' => 'kode_barang']);
    }
}
