<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\LogHistory;
use app\models\DataWarehouse;
use app\models\DataWarehouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataWarehouseController implements the CRUD actions for DataWarehouse model.
 */
class DataWarehouseController extends Controller
{
    // public function beforeAction($action)
    // {        
    //     if ( Yii::$app->user->isGuest ){
    //         return $this->redirect(['site/login']);
    //     }

    // }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DataWarehouse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DataWarehouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataWarehouse model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        $model_log = new LogHistory();
        $model = $this->findModel($id);
        date_default_timezone_set('Asia/Jakarta');
        $current_time = date('Y-m-d H:i:s');
        
        if ($model_log->load(Yii::$app->request->post()) ) {
            if (strtolower(trim($model_log->satuan)) == 'pcs'){
                $qty = $model->stok + $model_log->jumlah;
            }else{
                $qty = $model->stok + $model_log->jumlah * $model->konverter;
            }

            $model->stok = $qty;

            $model_log->departemen = '-';
            $model_log->kode_barang = $model->kode_barang;
            $model_log->nama_item = $model->nama_item;
            $model_log->waktu = $current_time;
            $model_log->aktivitas = 'masuk';
            $model_log->username = Yii::$app->user->identity->username;
            $model_log->save();
            // Yii::$app->db->createCommand("INSERT INTO log_history (kode_barang,nama_item, username , waktu , jumlah , aktivitas, departemen, user_ga) 
                                            // VALUES ('".$model->kode_barang."','".$model->nama_item."','-',current_timestamp, ".$_POST['ambil'].", 'ambil', '".$departemen."', '".$userGA."') ")->execute();
            if ($model->save()){
                Yii::$app->session->setFlash('success','Input Data Berhasil');
            }else{
                $model_log->delete();
                Yii::$app->session->setFlash('danger','Input Data Gagal');
            };
            return $this->redirect(['view', 'id' => $id]);
        }else{
            return $this->render('view', [
                'model' => $model,
                'model_log' => $model_log,
            ]);
        }
    }

    public function actionAmbilview($id)
    {
        $model_log = new LogHistory();
        $model = $this->findModel($id);
        date_default_timezone_set('Asia/Jakarta');
        $current_time = date('Y-m-d H:i:s');

        if ($model_log->load(Yii::$app->request->post()) ) {

            if (strtolower(trim($model_log->satuan)) == 'pcs'){
                $qty = $model->stok - $model_log->jumlah;
            }else{
                $qty = $model->stok - $model_log->jumlah * $model->konverter;
            }

            $model->stok = $qty;

            $model_log->kode_barang = $model->kode_barang;
            $model_log->nama_item = $model->nama_item;
            $model_log->waktu = $current_time;
            $model_log->aktivitas = 'keluar';
            $model_log->username = Yii::$app->user->identity->username;
            $model_log->save();
            // Yii::$app->db->createCommand("INSERT INTO log_history (kode_barang,nama_item, username , waktu , jumlah , aktivitas, departemen, user_ga) 
                                            // VALUES ('".$model->kode_barang."','".$model->nama_item."','-',current_timestamp, ".$_POST['ambil'].", 'ambil', '".$departemen."', '".$userGA."') ")->execute();
            if ($model->save()){
                Yii::$app->session->setFlash('success','Input Data Berhasil');
            }else{
                $model_log->delete();
                Yii::$app->session->setFlash('danger','Input Data Gagal');
            };
            return $this->redirect(['ambil-view', 'id' => $id]);
        }

        return $this->render('ambilview', [
            'model' => $model,
            'model_log' => $model_log,
        ]);
    }
    /**
     * Creates a new DataWarehouse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionTest()
    {
         return $this->render('testview');
    }

    public function actionCreate()
    {
        $searchModel = new DataWarehouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new DataWarehouse();
        $model->stok=0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataWarehouse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_barang]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataWarehouse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataWarehouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DataWarehouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataWarehouse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
