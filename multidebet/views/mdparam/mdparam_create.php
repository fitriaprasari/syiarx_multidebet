<?php //
/* Author       : fitriana.dewi
 * Created Date : 2018-01-05
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Formulir Penambahan Parameter Multidebet ';
$this->registerCss(".required label:after { content:' *';color:red; }");
?>
<div class="create">
        <div class="page-header" style="margin-top: 0px!important">
        <h2><?= Html::encode($this->title) ?></h2>
        </div>
    
    <?php echo Yii::$app->session->getFlash('status'); ?>
    <div class="form">
        <?php $form = ActiveForm::begin([
                    'id' => 'createParam-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-3',
//                            'offset' => 'col-sm-offset-3',
                            'wrapper' => 'col-sm-8',
                            'error' => '',
                            'hint' => '',
                            //'input' => 'input sm'
                        ],
                    ],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false
        ]);
        ?>
        <?= $this->render('mdparam_form',['model'=>$model,'form' => $form]);?>

        <div class="container-fluid form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'],['style'=>'width:300px']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>