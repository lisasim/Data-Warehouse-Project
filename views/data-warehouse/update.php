<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataWarehouse */

$this->title = 'Update Data Barang ATK, APP dan APD ' . $model->kode_barang;
$this->params['breadcrumbs'][] = ['label' => 'Data Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_barang, 'url' => ['view', 'id' => $model->kode_barang]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-warehouse-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
