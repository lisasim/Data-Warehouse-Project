<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DataWarehouse */

$this->title = $model->kode_barang;
$this->params['breadcrumbs'][] = ['label' => 'Data Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="data-warehouse-ambilview">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kembali', ['index', 'id' => $model->kode_barang], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->kode_barang], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_barang], [
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
            'jumlah_per_pcs',
        ],
    ]) ?>

    <html>
    <head>
    <style>
        .error {color: #FF0000;}
    </style>
    </head>
    <body>  

    <?php
        $nilai = 0;
        $username = $usernameErr = $nilaiErr = "";

        if (isset($_POST["ambil"])||isset($_POST["username"])){

            if ($_POST['ambil']==NULL && $_POST['username']!=NULL){
                $nilaiErr = "Nilai tidak boleh kosong";
            }
            else if ($_POST['ambil']!=NULL && $_POST['username']==NULL){
                $usernameErr = "Username tidak boleh kosong";
            }
            else if ($_POST['ambil']==NULL && $_POST['username']==NULL){
                $nilaiErr = "Nilai tidak boleh kosong";
                $usernameErr = "Username tidak boleh kosong";
            }
            else if ($_POST['ambil']!=NULL && $_POST['username']!=NULL){
                $nilai = $model->stok - $_POST['ambil'];
                $username = $_POST['username'];
                Yii::$app->db->createCommand("UPDATE warehouse.data_warehouse SET stok=".$nilai." WHERE kode_barang = '".$model->kode_barang."' ")->execute();
                Yii::$app->db->createCommand("INSERT INTO Warehouse.log_history (kode_barang, username , waktu , jumlah , aktivitas) VALUES ('".$model->kode_barang."','".$username."',current_timestamp, ".$_POST['ambil'].", 'ambil') ")->execute();
                header("Refresh:0");
            }
        }
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
    <br>
    <h4><b>Ambil Barang</b></h4>

    <div class="form">
        <label for="ambil"><?php echo "(satuan : " . $model->satuan_pengeluaran.")"; ?></label><br>
        Username : <input type="text" min='0' name='username'/>
        <span class="error">* <?php echo $usernameErr;?></span>
        <br>
        Jumlah : <input type="number" min='0' name='ambil'/>
        <span class="error">* <?php echo $nilaiErr;?></span>
        <br>
        <input type="submit" value='Submit' formmethod='post'>        
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
