<?php
//HALAMAN VIEW INPUT BARANG

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
        $userGA = $nilaiErr = $userGAErr = "";

        if (isset($_POST["userGA"])||isset($_POST["tambah"])||isset($_POST["username"])){

            if ($_POST['userGA']==NULL){
                $userGAErr = "Nama user GA tidak boleh kosong";
            }
            /*

            if ($_POST['username']==NULL){
                $usernameErr = "Nama user tidak boleh kosong";
            }
            */

            if ($_POST['tambah']==NULL){
                $nilaiErr = "Nilai tidak boleh kosong";
            }

            if ($_POST['userGA']!=NULL && $_POST['tambah']!=NULL){
                $userGA = $_POST['userGA'];
                $nilai = ($_POST['tambah'] * $model->konverter) + $model->stok;
                //$username = $_POST['username'];
                Yii::$app->db->createCommand("UPDATE warehouse.data_warehouse SET stok=".$nilai." WHERE kode_barang = '".$model->kode_barang."' ")->execute();
                Yii::$app->db->createCommand("INSERT INTO Warehouse.log_history (kode_barang, username , waktu , jumlah , aktivitas, departemen, user_ga) VALUES ('".$model->kode_barang."','-',current_timestamp, ".$_POST['tambah'].", 'input', '-', '".$userGA."') ")->execute();
                //header("Refresh:0");
                Yii::$app->session->setFlash('success', 'Input Barang Berhasil');
                Yii::$app->response->redirect(['data-warehouse/view', 'id'=>$model->kode_barang]);
                //header("Refresh:0");
                //common\widgets\Alert::widget();

            }

        }
    ?>

    <?php $form = ActiveForm::begin(); ?>
    
    <br>
    <h4><b>Input Barang</b></h4>

    <div class="form">
        <label for="userGA">Nama User GA :</label> 
        <br>
        <input type="text" min='0' name='userGA'/>
        <span class="error">* <?php echo $userGAErr;?></span>
        <br>
        <label for="tambah">Jumlah :</label> 
        <br>
        <input type="number" min='0' name='tambah'/>
        <span class="error">* <?php echo $nilaiErr ;?><?php echo "(satuan : " . $model->satuan_pembelian.")"; ?></span>
        <br><br>
        <input type="submit" value='Submit' formmethod='post'>        
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
