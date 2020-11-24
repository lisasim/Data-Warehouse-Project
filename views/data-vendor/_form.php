<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataVendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-vendor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_vendor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
