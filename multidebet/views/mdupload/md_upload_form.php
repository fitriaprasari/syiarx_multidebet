<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;
use Yii;

/* @var $this yii\web\View */
$this->title = 'Upload File Data Multidebet';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--Alert Area-->
<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    if (is_array($message)) {
        foreach ($message as $item) {
            echo '<div class="alert alert-' . $key . '">' . $item . '</div>';
        }
    } else {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }
}
?>

<!--Title Area-->
<div class="page-header" style="margin-top:0px!important">
    <h3><?= Html::encode($this->title) ?></h3><br/>
</div>

<!--Upload Rule Area-->
<p><b>Ketentuan Upload File Data Multidebet :</b></p>
<p>1. File Data Multidebet disimpan dalam format <b>.csv</b></p>
<p>2. Format nama file adalah sebagai berikut :</p>
<p><b>Tahun(tanpaspasi)Bulan(tanpaspasi)Tanggal(tanpaspasi)
      No.Seq_File_Dibuat(titik)Nama_Parameter</b></p>
<p>Contoh : <b>2017102502.LOCBTA.csv</b></p>

<div>&nbsp;</div>

<!--Upload Form Area-->
<?php $form = ActiveForm::begin(['options' =>
                                ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model_master, 'nama_file_upload')->fileInput() ?>

<!--date exec-->
<?=
$form->field($model_master, 'date_exec')
     ->widget(\yii\jui\DatePicker::classname(), 
     [
        //'language' => 'ru',
        'dateFormat' => 'yyyyMMdd',
     ])
?>

<!--time exec-->
<?=
    $form->field($model_master, 'time_exec')
         ->widget(TimePicker::classname(),
         [
//             'timeFormat'=>'his',
         ]);
?>

<?=
Html::submitButton('Upload', [
    'class' => 'btn btn-primary',
    'onclick' => 'return upload()',
    'id' => 'uploadbutton'
    ]);
?>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<?php ActiveForm::end() ?>