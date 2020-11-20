<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataWarehouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-warehouse-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode_barang') ?>

    <?= $form->field($model, 'nama_item') ?>

    <?= $form->field($model, 'satuan_pengeluaran') ?>

    <?= $form->field($model, 'satuan_pembelian') ?>

    <?= $form->field($model, 'harga') ?>

    <?php // echo $form->field($model, 'Pembelian_by') ?>

    <?php // echo $form->field($model, 'Vendor') ?>

    <?php // echo $form->field($model, 'Stok') ?>

    <?php // echo $form->field($model, 'Koordinat') ?>

    <?php // echo $form->field($model, 'Konverter') ?>

    <?php // echo $form->field($model, 'Jumlah_per_pcs') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
