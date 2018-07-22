<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\multidebet\models\PayrollUploadMaster_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payroll Upload Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payroll-upload-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Payroll Upload Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_parameter',
            'nama_file_upload:ntext',
            'nama_file_process:ntext',
            'date_upload',
            'date_exec',
            // 'valid_stat',
            // 'co_code',
            // 'charge_flag',
            // 'acctno_charge',
            // 'charge_amt',
            // 'time_upload',
            // 'time_exec',
            // 'otor_stat',
            // 'otor_date',
            // 'otor_tm',
            // 'exec_stat',
            // 'date_process',
            // 'inputter_name',
            // 'authoriser_name',
            // 'inputter',
            // 'authoriser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>