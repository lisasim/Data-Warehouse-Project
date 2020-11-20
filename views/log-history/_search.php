<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogHistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode_barang') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'waktu') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'aktivitas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
