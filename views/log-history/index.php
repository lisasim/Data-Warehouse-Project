<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_barang',
            'username',
            'waktu',
            'jumlah',
            //'id',
            'aktivitas',
        ],
    ]); ?>


</div>
