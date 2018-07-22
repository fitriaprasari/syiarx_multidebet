 <?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\multidebet\models\Mdebitparameter */

$this->title = $model->kode_parameter;
$this->params['breadcrumbs'][] = ['label' => 'Mdebitparameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdparam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->kode_parameter], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->kode_parameter], [
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
            'kode_parameter',
            'nama_institusi',
            'charge_flag',
            'charge_code',
            'charge_type',
            'narasi',
            'tipe_transaksi',
            'charge_amt',
            'acctno',
            'co_code',
            'branch_nm',
            'acctname',
            'acctno_charge',
            'branch_co_code',
        ],
    ]) ?>

</div>
