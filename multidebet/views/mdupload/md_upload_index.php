<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
\yii\bootstrap\BootstrapPluginAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\modules\payroll\models\Payrollupload_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Data Upload Multidebet';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    .row {
        margin-right: 100px;
    }
    #option{
        width: 300px;
        length: 10px;
    }
</style>

<div class="payrollupload-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php echo Yii::$app->session->getFlash('status'); ?>
    <?php Pjax::begin(['id' => 'pjax-gridview']) ?>
    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => "overflow: auto; height: 500px"],
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'kode_parameter',
             'label'=> 'Kode Parameter'],
            ['attribute' => 'nama_file_upload',
             'label'=> 'Nama File Upload'],
            ['attribute' => 'nama_file_process',
             'label'=> 'Nama File Process'],
            'inputter',
            'authoriser',
            ['attribute' => 'co_code',
             'label'=> 'Kode Cabang'],
            ['attribute' => 'date_upload',
             'label'=> 'Tanggal Upload'],
            ['attribute' => 'time_upload',
             'label'=> 'Jam Upload'],
            ['attribute' => 'date_exec',
             'label'=> 'Tanggal Eksekusi'],
            ['attribute' => 'time_exec',
             'label'=> 'Jam Eksekusi'],
            ['attribute' => 'valid_stat',
             'label'=> 'Status Validasi'],
            ['attribute' => 'otor_stat',
             'label'=> 'Status Otorisasi'],
            ['attribute' => 'otor_date',
             'label'=> 'Tanggal Otorisasi'],
            ['attribute' => 'otor_tm',
             'label'=> 'Jam Otorisasi'],
//            ['attribute' => 'charge_flag',
//             'label'=> 'Flag Biaya'],
//            ['attribute' => 'acctno_charge',
//             'label' => 'No.Rek.Biaya'],
//            ['attribute' => 'charge_amt',
//             'label'=> 'Nominal Biaya'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{read}{process}{delete}',
                
                'buttons' => [
                    'headerOptions' => ['style' => 'width:100%'],

                    'read'=> function($url, $model, $aksi_btn) {
                            if($model['valid_stat'] == 'ERROR'){
                                
                                $aksi_btn = "Edit Data";
                                return 
                                Html::a($url = Html::a($aksi_btn,
                                ['/multidebet/mdupload/detaildata?'
                                .'kode_parameter='.$model['kode_parameter']
                                .'&nama_file_upload='.$model['nama_file_upload']],
                                ['class' => 'btn btn-primary',
                                 'data-method'=>'post',]));
                                
                            }else if($model['valid_stat'] == 'VALID'){
                                
                                $aksi_btn = "Lihat Detail";
                                return
                                Html::a($url = Html::a($aksi_btn,
                                    ['/multidebet/mdupload/detaildata?'
                                    .'kode_parameter='.$model['kode_parameter']
                                    .'&nama_file_upload='.$model['nama_file_upload']],
                                    ['class' => 'btn btn-primary',
                                     'data-method'=>'post',]));
                            }
                            else{
                                $aksi_btn = '';
                            }
                        },
                            
                    'delete' => function($url, $model) {

                            if($model['valid_stat'] == 'ERROR'){
                            return Html::a(
                            $url = Html::a('Delete',
                            ['/multidebet/mdupload/deletetemp?kode_parameter='
                             .$model['kode_parameter'].'&nama_file_upload='
                             .$model['nama_file_upload']],
                            ['class' => 'btn btn-danger', 'data-method'=>'post',
                             'data'  => [ 
                                    'confirm' => 
                                    'Apakah anda yakin akan menghapus file "'
                                    .$model['nama_file_upload'].'" ?',
                                    'method' => 'post',]
                            ]));
                                
                            }else if($model['valid_stat'] == 'VALID'){
                                
                            return Html::a(
                            $url = Html::a('Delete',
                            ['/multidebet/mdupload/delete?kode_parameter='
                             .$model['kode_parameter'].'&nama_file_upload='
                             .$model['nama_file_upload']],
                            ['class' => 'btn btn-danger', 'data-method'=>'post',
                             'data'  => [ 
                                    'confirm' => 
                                    'Apakah anda yakin akan menghapus file "'
                                    .$model['nama_file_upload'].'" ?',
                                    'method' => 'post',]
                            ]));
                            }
                            else{
                                $aksi_btn = '';
                            }
                   },
                ],
            ],
        ],
    ]);
    ?>
    
    <?php Pjax::end() ?>

</div>

