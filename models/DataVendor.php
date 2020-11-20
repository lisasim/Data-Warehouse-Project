<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_vendor".
 *
 * @property int $id
 * @property string|null $nama_vendor
 */
class DataVendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['nama_vendor'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_vendor' => 'Nama Vendor',
        ];
    }
}
