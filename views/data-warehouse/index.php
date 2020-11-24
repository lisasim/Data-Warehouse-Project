<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DataWarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Barang ATK, APP dan APD';
$this->params['breadcrumbs'][] = $this->title;
$urlVendor ='index.php?r=data-vendor/create';
?>
<div class="data-warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Data Barang', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Tambah Vendor', $urlVendor, ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_barang',
            'nama_item',
            'satuan_pengeluaran',
            'satuan_pembelian',
            //'harga',
            //'pembelian_by',
            //'vendor',
            'stok',
            //'koordinat',
            //'konverte',
            //'jumlah_per_pcs',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{input}{ambil}',
                'contentOptions' => ['class' => 'text-center'],
                'buttons' => [
                    'input' => function ($url, $model) {
                        return Html::a('Input Barang', $url, ['class' => 'btn btn-primary','style'=>'width:150px;margin-bottom:5px']);
                        //return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'view'),]);
                    },

                    'ambil' => function ($url, $model) {
                        return Html::a('Ambil Barang', $url, ['class' => 'btn btn-success','style'=>'width:150px;']);
                        //return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'view'),]);
                    },

                    /*

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'update'),
                        ]);
                    },

                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'delete'),
                        ]);
                    }
                    */

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'input') {
                        $url ='index.php?r=data-warehouse/view&id='.$model->kode_barang;
                        return $url;
                    }

                    if ($action === 'ambil') {
                        $url ='index.php?r=data-warehouse/ambilview&id='.$model->kode_barang;
                        return $url;
                    }


                    /*
                    if ($action === 'update') {
                        $url ='index.php?r=data-warehouse/update&id='.$model->kode_barang;
                        return $url;
                    }

                    if ($action === 'delete') {
                        $url ='index.php?r=data-warehouse/delete&id='.$model->kode_barang;
                        return $url;
                    }
                    */

                }
               
            ],
        ]
    ]); ?>

</div>
