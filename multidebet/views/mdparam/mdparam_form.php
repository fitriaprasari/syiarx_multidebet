<?php
/* Author       : fitriana.dewi
 * Created Date : 2018-01-05
 */
/* @var $this yii\web\View */
/* @var $model \app\modules\payroll\models\PayrollParameter */
/* @var $form ActiveForm */
namespace yii\widgets;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\payroll\models\Parameterpayroll */
?>
        <!--kode parameter-->
        <?= $form->field($model, 'kode_parameter')
                 ->textInput(['maxlength'=>true,'style'=>'text-transform: uppercase' ])?>
        
        <!--nama institusi/perusahaan-->
        <?= $form->field($model, 'nama_institusi')->textInput(['maxlength'=>true,'style'=>'text-transform: uppercase']) ?>
        
        <!--tipe transaksi-->
        <div class="acctno">
            <?=
            $form->field($model, 'tipe_transaksi', ['template' => "{label}<div class='col-sm-4'>{input}{error}{hint}</div>"])->dropDownList(
                ['' => 'Pilih',
                'Multidebet' => 'Multidebet',
                ],
                ['style' => 'height: auto; width: auto;']);
            ?>
        </div>
                
        <!--flag biaya-->
        <?=
         $form->field($model,'charge_flag',['inputTemplate'=>'<div class="">{input}</div>','template'=>'{label}'
             . '<div class="row">'
             . '<div class="col-sm-2">{input}{error}{hint}</div>'
             . '<span style = "margin-top:8px; display:block;" id="charge_flag"></span>'
             . '</div>'])->dropDownList([''=> 'Pilih',
                    'Y'=>'Y',
                    'T'=>'T'],
                     ['style' => 'height: auto; width: auto;']);
        ?>
                
        <!--narasi/keterangan-->
        <div class="keterangan" width='300px'>
        <?= $form->field($model, 'narasi', ['template' => "{label}\n<div class='col-sm-3'>{input}</div>\n{error}",
                                            ])
                 ->dropDownList([''=>'Pilih',
                                 'Biaya Dibebankan ke Rekening Perusahaan'=>'Biaya Dibebankan ke Rekening Perusahaan',
                                 'Biaya Dibebankan ke Rekening Karyawan'=>'Biaya Dibebankan ke Rekening Karyawan',
                               ],['style'=>'height: auto; width: auto;']);
        ?>
        </div>
        
        <!--nomor rekening debit-->
            <!--field acctno-->
            <?=
            $form->field($model, 'acctno')->textInput(['style' => 'width:250px',
                'maxlength' => true, 'readonly' => false, 'onblur' => ''
                . 'if(this.value != ""){'
                . '    $("#image-desc-loader").show();'
                . '    var branch_co_code="";'

                //start of function mdparam/getaccount
                . '    $.post("' . Url::toRoute("mdparam/getaccount") . '", { id: this.value } ).done(function(data){ '
                . '    var obj = JSON.parse(data);'

                //. 'check whether acctno exist or not'
                . '         if(obj.status == "NA"){'
                . '             $("#' . Html::getInputId($model, 'acctno') . '").val("");'
                . '             $("#' . Html::getInputId($model, 'acctname') . '").val("");'
                . '             alert("No. Rekening tidak ditemukan.");'
                . '         }'
                . '         else{'
                . '             $("#' . Html::getInputId($model, 'acctname') . '").val(obj.account_title);'
                //. 'end of function mdparam/getaccount'

                . '             branch_co_code = obj.co_code;'
                . '             $("#'.Html::getInputId($model,'branch_co_code').'").val(branch_co_code);'
                . '             $.post("' . Url::toRoute("mdparam/getbranchname") . '", { id: branch_co_code } ).done(function(data){ '
                . '             var obj = JSON.parse(data);'
                . '             var branch_nm = obj.branch_nm;'
                . '             $("#'.Html::getInputId($model,'branch_nm').'").val(branch_nm);'
                . '             });'
                . '             var keterangan = $("#'.Html::getInputId($model,'narasi').'").val();'
                . '             if(keterangan == "Biaya Dibebankan ke Rekening Perusahaan"){'
                . '                 var acctno = $("#'.Html::getInputId($model,'acctno').'").val();'
                . '                 $("#'.Html::getInputId($model,'acctno_charge').'").val(acctno);'
                . '             }'
                . '             else{'
                . '                 $("#'.Html::getInputId($model,'acctno_charge').'").val("");'
                . '             }'
                . '         }    '
                . '    });'
                . '$("#image-desc-loader").hide();'
                . '};'
            ]);
            ?>

            <!--nama pemilik rekening debet-->
            <?= $form->field($model,'acctname')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            <!--nama pemilik rekening debit-->

            <!--kode cabang rekening debit-->
                   <?= $form->field($model, 'branch_co_code')->textInput(['maxlength' => true, 'style'=>'text-transform: uppercase','width:175px','readonly'=>false, 'onblur'=>''
                . 'if(this.value != ""){'
                . '    $("#image-desc-loader").show();'
                . '    $.post("'. Url::toRoute("mdparam/getbranchname") . '", { id: this.value } ).done(function(data){ '
                . '         var obj = JSON.parse(data);'
                . '         if(obj.status == "NA"){'
                . '             $("#'. Html::getInputId($model,'branch_nm'). '").val("");'
                . '             alert("Kode cabang tidak ditemukan.");'
                . '         }'
                . '         else{'
                . '             $("#'.Html::getInputId($model,'branch_nm').'").val(obj.branch_nm);'
                . '         }'
                . '         $("#branch_nm").html(obj.branch_nm);'
                . '         $("#image-desc-loader").hide();'
                . '    });'
                . '}'
                ]);
            ?>

            <!--nama cabang rekening debit-->
            <?= $form->field($model, 'branch_nm')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            <!--nomor rekening biaya-->
            <?= $form->field($model, 'acctno_charge')->textInput(['readonly'=>true],['style' => 'width:175px']) ?>

        
       
        
        <!--kode biaya-->
        <?= $form->field($model, 'charge_code')->textInput(['readonly'=>true]) ?>
        
        <!--tipe biaya-->
        <?= $form->field($model, 'charge_type')->textInput(['readonly'=>true]) ?>

        <!--nominal biaya-->
        <div class="charge_amt">
            <?=
                    $form->field($model, 'charge_amt', ['template' => "{label}\n<div class='col-sm-4'>{input}\n{error}</div>"])->textInput(['maxlength' => true,
                        'style' => 'text-transform: uppercase',
                        'readonly' => false, 'onblur' => ''])->
                        widget(MaskedInput::className(), [
                        'clientOptions' => [
                            'alias' => 'decimal',
                            'groupSeparator' => ',',
                            'autoGroup' => true,
                            'rightAlign' => false,],
                        'options' => [
                            'class' => 'form-control',
//                            'readonly' => !$model->isNewRecord
            ]]);
            ?>
        </div>
        
<!-- app-modules-payroll-views-parameterpayroll-add_parameter -->

<!--AJAX-->
        <!--image-loader-->
        <div id="image-desc-loader" style="display: none">
                <img src="../../images/ajax-loader.gif"/>
                <i>Mencari..</i>
        </div>
    
<?php

$this->registerJs(
        '$(document).ready(function(){'
        . ''
        //FLAG BIAYA
        //If selected value == 'Y' then charge_code => DEBET PLUS CHARGES 
        //and charge_type =>PAYROLLCOMM
        . '$("#'.Html::getInputId($model,'charge_flag').'").change('
        . 'function(e){'
        . 'e.preventDefault();'
        . 'var flag = $("#'.Html::getInputId($model,'charge_flag').'").val();'
        . 'if(flag == "Y"){'
        . '         $("#'.Html::getInputId($model,'charge_flag').'").val("Y");'
        . '         $("#'.Html::getInputId($model,'charge_code').'").val("DEBIT PLUS CHARGES");'
        . '         $("#'.Html::getInputId($model,'charge_type').'").val("PAYROLLCOMM");'
        . '         $("#'.Html::getInputId($model,'narasi').'").prop("disabled", false);'
        . '         $("#'.Html::getInputId($model,'charge_amt').'").prop("disabled", false);'
        . '     }'
        . 'else if(flag == "T"){'
        .'          $("#'.Html::getInputId($model,'charge_code').'").val("");'
        . '         $("#'.Html::getInputId($model,'charge_type').'").val("");'
        . '         $("#'.Html::getInputId($model,'charge_amt').'").val("");'
        . '         $("#'.Html::getInputId($model,'acctno_charge').'").val("");'
        . '         $("#'.Html::getInputId($model,'narasi').'").val("");'
        
        . '         $("#'.Html::getInputId($model,'narasi').'").prop("disabled", true);'
        . '         $("#'.Html::getInputId($model,'charge_amt').'").prop("disabled", true);'
        . '     }'
        . '$("#charge_code").html(charge_code);'
        . '$("#charge_type").html(charge_type);'
        . '$("#charge_flag").html(charge_flag);'
        . '})'
        . '});'
        . ''
        . ''
        . ''
//        . '$("#'.Html::getInputId($model,'charge_flag').'").change('
//        . 'function(e){'
//        . 'e.preventDefault();'
//        . 'if(this.value == "Y"){'
//        . '$("#add-acctno").prop("disabled", true);'
//        . '}else{'
//        . '$("#add-acctno").prop("disabled", false);'
//        . '}'
//        . '});'
        
        //KETERANGAN
        //If selected value == 'Biaya dibebankan ke rekening Perusahaan' then
        //acctno_charge => no.rek perusahaan
        . '$("#'.Html::getInputId($model,'narasi').'").change('
        . 'function(e){'
        . 'e.preventDefault();'
        . 'var selected = $("#'.Html::getInputId($model,'narasi').'").val();'
        . 'if(selected == "Biaya Dibebankan ke Rekening Perusahaan"){'
        . '     var acctno = $("#'.Html::getInputId($model,'acctno').'").val();'
        //. 'alert(acctno);'
        . '     $("#'.Html::getInputId($model,'acctno_charge').'").val(acctno);'
        . '     $("#'.Html::getInputId($model,'narasi').'").val();'
        . '}else{'
        . '     $("#'.Html::getInputId($model,'acctno_charge').'").val("");'
        . '}'
        . '$("#narasi").html(narasi);'
        . '});'
        . ''
        . 'var tipe_transaksi;'
        . '$("#'.Html::getInputId($model,'tipe_transaksi').'").change('
        . 'function(e){'
        . 'e.preventDefault();'
        . 'tipe_transaksi = this.value;'
        . '});'
        //BTN ADD acct no
        . '$("#tambah_acctno").click('
        . 'function(e){'
        . 'e.preventDefault();'
        . '});'
       
);
?>

    <script type="text/javascript">
        $(".tipe_transaksi").bind('change', function () { alert('hello!'); };);
//    $("#tipe_transaksi").change(function(e){
//        e.preventDefault();
//        var tipe = this.value();
//        alert(tipe);
    })
    //Fungsi untuk menambahkan no.rekening debit untuk jenis multi debit
//    function add_acctno(){
//    var next = 1;
//    $(".add-more").click(function(e){
//        e.preventDefault();
//        var addto = "#field" + next;
//        var addRemove = "#field" + (next);
//        next = next + 1;
//        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
//        var newInput = $(newIn);
//        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
//        var removeButton = $(removeBtn);
//        $(addto).after(newInput);
//        $(addRemove).after(removeButton);
//        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
//        $("#count").val(next);  
//        
//            $('.remove-me').click(function(e){
//                e.preventDefault();
//                var fieldNum = this.id.charAt(this.id.length-1);
//                var fieldID = "#field" + fieldNum;
//                $(this).remove();
//                $(fieldID).remove();
//            });
//    });
//    }
      function add_acctno(){
          var tipe_transaksi = $("#tipe_transaksi").val();
          alert("tipe_transaksi");
          };
    </script>