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

    <html>
    <head>
    <style>
        .error {color: #FF0000;}
    </style>
    </head>
    <body>  

    <?php
        $nilai = 0;
        $username = $usernameErr = "";
        $userGA = $departemen = $userGAErr = $nilaiErr = $departemenErr = "";

        if (isset($_POST["userGA"])||isset($_POST["ambil"])||isset($_POST["username"])||isset($_POST["departemen"])){

            if ($_POST['userGA']==NULL){
                $userGAErr = "Nama user GA tidak boleh kosong";
            }

            /*

            if ($_POST['username']==NULL){
                $usernameErr = "Nama user tidak boleh kosong";
            }
            */

            if ($_POST['departemen']==NULL){
                $departemenErr = "Departemen tidak boleh kosong";
            }

            if ($_POST['ambil']==NULL){
                $nilaiErr = "Nilai tidak boleh kosong ";
            }

            if ($_POST['userGA']!=NULL && $_POST['ambil']!=NULL && $_POST['departemen']!=NULL){
                $userGA = $_POST['userGA'];
                $nilai = $model->stok - $_POST['ambil'];
                //$username = $_POST['username'];
                $departemen = $_POST['departemen'];
                Yii::$app->db->createCommand("UPDATE warehouse.data_warehouse SET stok=".$nilai." WHERE kode_barang = '".$model->kode_barang."' ")->execute();
                Yii::$app->db->createCommand("INSERT INTO Warehouse.log_history (kode_barang, username , waktu , jumlah , aktivitas, departemen, user_ga) VALUES ('".$model->kode_barang."','-',current_timestamp, ".$_POST['ambil'].", 'ambil', '".$departemen."', '".$userGA."') ")->execute();
                //header("Refresh:0");
                Yii::$app->session->setFlash('success', 'Ambil Barang Berhasil');
            } 

/*
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

            */
        }
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
    <br>
    <h4><b>Ambil Barang</b></h4>

    <div class="form">
        <label for="userGA">Nama User GA :</label> 
        <br>
        <input type="text" name='userGA'/>
        <span class="error">* <?php echo $userGAErr;?></span>
        <br>
        <label for="departemen">Departemen :</label> 
        <br>
        <input type="text" name='departemen'/>
        <span class="error">* <?php echo $departemenErr;?></span>
        <br>
        <label for="userGA">Jumlah :</label> 
        <br>
        <input type="number" min='0' name='ambil'/>
        <span class="error">* <?php echo $nilaiErr;?><?php echo "(satuan : " . $model->satuan_pengeluaran.")"; ?></span>
        <br><br>
        <input type="submit" value='Submit' formmethod='post'>        
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
