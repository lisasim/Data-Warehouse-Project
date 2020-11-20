<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataWarehouse */

$this->title = 'Create Data Barang ATK, APP dan APD';
$this->params['breadcrumbs'][] = ['label' => 'Data Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-warehouse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
