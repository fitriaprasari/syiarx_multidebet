<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use app\modules\multidebet\models\Mdparam;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

\yii\bootstrap\BootstrapPluginAsset::register($this);

$this->title = 'Daftar Parameter Multidebet';
$this->params['breadcrumbs'][] = $this->title;
?>

<style type="text/css">
    .row {
        margin-right: 20px;
    }
    #option{
        width: 200px;
        length: 20px;
    }
</style>

<div class="mdebitparameter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Yii::$app->session->getFlash('status')?>
    
     <div>&nbsp;</div>
     
     <form action="getparamby" method="POST">
        <div class="form-group row-fluid">
        <div class="col-md-3" align="center">
            <?php
            $model = new Mdparam();
            $arrFields = $model->attributeLabels();
            //$data = ArrayHelper::map(Parameterpayroll::find()->all(),'charge_amt','charge_amt');
            ?>

            <?=
            Html::dropDownList('mdparam', null, $arrFields, ['id'=>'parameterpayroll','prompt' => '- cari berdasarkan -', 'class' => 'form-control',
            ]);
            ?>
        </div> 
        
        <div>
            <div class="mdparam-search">
                <!--form input pencarian-->
                    <div class="form-group col-xs-4">
                        <input type="text" class="form-control" name="query_form" style="text-transform: uppercase" placeholder="masukan kata kunci">
                    </div>
                    <!--end of form input pencarian-->

                    <!--Tombol Pencarian-->
                    <div align="left">
                        <?php $form = ActiveForm::begin(['action'=>['getparamby'],]);?>

                            <div class="button-getparam-by">
                            <?php // Html::submitButton('Search', ['class' => 'btn btn-primary','name'=>'search_param','onclick'=>'js:myFunction()'])?>
                                <?= Html::submitButton('Search', ['class' => 'btn btn-primary','name'=>'search_param'])?>
                                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
                            </div>
        
                        <?php ActiveForm::end(); ?>
                    </div>
                <!--End of Tombol Pencarian-->
    </form>
     
     <!--Tombol Buat Parameter Baru-->
     <?php $form = ActiveForm::begin(['action' => ['create'],]); ?>
     <div align="right">
         <form action="create">
             <div class="button-create-parameter">
                 <?= Html::submitButton('Buat Parameter Baru', ['class' => 'btn btn-primary']); ?>
             </div> 
         </form>
     </div>
     <?php ActiveForm::end(); ?>
     <!--End of Tombol Buat Parameter Baru-->
     
    <?php
     $form = ActiveForm::begin([
                 'id' => 'dynamic-form',
                 'method' => 'get',
                 'layout' => 'horizontal',
                 'fieldConfig' => [
                     'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                     'horizontalCssClasses' => [
                         'label' => 'col-sm-2',
                         //'offset' => 'col-sm-offset-2',
                         'wrapper' => 'col-sm-8',
                         'error' => '',
                         'hint' => '',
                     //'input' => 'input sm'
                     ],
                 ],
                 'enableAjaxValidation' => false,
                 'enableClientValidation' => false,
                 'action' => 'create',
     ]);
     ?>        
</div>
<?php ActiveForm::end(); ?>

<div>&nbsp;</div>
    <!--Gridview data parameter-->
    <?php Pjax::begin(['id' => 'pjax-gridview']) ?>
            
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['style' => "overflow: auto; height: 300px"],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'kode_parameter',
                'nama_institusi',
                'acctno',
                'acctname',
                'branch_co_code',
                'branch_nm',
                'tipe_transaksi',
                'charge_flag',
                'charge_code',
                'charge_type',
                'acctno_charge',
                'charge_amt',
                'narasi',
                'co_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
     <?php Pjax::end() ?>
     <!--End of Gridview data parameter-->

</div>