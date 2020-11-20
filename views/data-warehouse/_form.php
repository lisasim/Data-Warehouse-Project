<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\DataVendor;
use app\models\DataWarehouse;

/* @var $this yii\web\View */
/* @var $model app\models\DataWarehouse */
/* @var $form yii\widgets\ActiveForm */

$satuanPengeluaran = [
    1 => 'buku', 
    2 => 'box',
    3 => 'roll',
    4 => 'Dozen(s)',
    5 => 'galon',
    6 => 'set',
    7 => 'meter',
    8 => 'lusin',
    9 => 'prs',
    10 => 'lembar',
    11 => 'rim',
    12 => 'strip',
    13 => 'liter',
    14=> 'gulung',
    15 => 'dus',
    16 => 'pack',
    17 => 'kg',
    18 => 'pak',
    19 => 'pcs',
    20 => 'ball'
];

$satuanPembelian = [
    1 => 'dus', 
    2 => 'pcs',
    3 => 'ball',
    4 => 'karung',
    5 => 'pasang',
    6 => 'box',
    7 => 'roll',
    8 => 'rim',
    9 => 'lusin',
    10 => 'galon',
    11 => 'set',
    12 => 'meter',
    13 => 'pail',
    14=> 'prs',
    15 => 'lembar',
    16 => 'rim',
    17 => 'strip',
    18 => 'liter',
    19 => 'gulung',
    20 => 'kilogram',
    21 => 'pak'
];

$pembelianBy = [
    1 => 'Supplier', 
    2 => 'PCT Lapangan',
    3 => 'Beli Sendiri',
    4 => 'Email ke Mas Imam',
    5 => 'Minta ke GA HO',
    6 => '-'
];


?>

<div class="data-warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_barang')->textInput() ?>

    <?= $form->field($model, 'nama_item')->textInput() ?>

    <?= $form->field($model, 'satuan_pengeluaran')->dropDownList($satuanPengeluaran,['prompt'=>'Select..']);?>

    <?= $form->field($model, 'satuan_pembelian')->dropDownList($satuanPembelian,['prompt'=>'Select..']);?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <?= $form->field($model, 'pembelian_by')->dropDownList($pembelianBy,['prompt'=>'Select..']);?>

    <?= $form->field($model, 'vendor')->dropDownList(ArrayHelper::map(DataVendor::find()->all(),'id','nama_vendor'),['prompt'=>'Select Vendor']);?>

    <?= $form->field($model, 'koordinat')->textInput() ?>

    <?= $form->field($model, 'konverter')->textInput() ?>

    <?= $form->field($model, 'jumlah_per_pcs')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
