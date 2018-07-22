 <?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\multidebet\models\Mdparam */

$this->title = 'Update Mdparam: ' . ' ' . $model->kode_parameter;
$this->params['breadcrumbs'][] = ['label' => 'Mdparams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_parameter, 'url' => ['view', 'id' => $model->kode_parameter]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mdparam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('mdparam_form', [
        'model' => $model,
    ]) ?>

</div>
