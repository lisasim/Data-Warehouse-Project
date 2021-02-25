<?php
//HALAMAN VIEW INPUT BARANG

use app\models\DataWarehouse;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\dialog\Dialog;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\DataWarehouse */

$this->title = $model->kode_barang;
$this->params['breadcrumbs'][] = ['label' => 'Data Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="data-warehouse-inputview">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['index', 'id' => $model->kode_barang], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete Data Barang', ['delete', 'id' => $model->kode_barang], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_barang',
            'nama_item',
            'satuan_pengeluaran',
            'satuan_pembelian',
            'harga',
            'pembelian_by',
            'vendor',
            'stok',
            'koordinat',
            'konverter',
            //'jumlah_per_pcs',
        ],
    ]) ?> 
 
</div>

<div class="data-warehouse-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model_log, 'user_ga')->textInput() ?>
<?= $form->field($model_log, 'jumlah')->textInput()->label("Jumlah yang akan dimasukkan ke stok")->hint('Isi dengan jumlah dalam satuan pembelian') ?>
<?php 
    echo $form->field($model_log, 'satuan')->widget(Select2::classname(), [
        'data' => array_merge(['pcs'=>'pcs'],ArrayHelper::map(DataWarehouse::find()->where("kode_barang = '".$model->kode_barang."' and satuan_pembelian not ilike '%pcs%' ")->all()
        ,'satuan_pembelian','satuan_pembelian')),
        'options' => ['placeholder' => 'Pilih Satuan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>