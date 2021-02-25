<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataVendor */

$this->title = 'Create Data Vendor';
//$this->params['breadcrumbs'][] = ['label' => 'Data Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-vendor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
