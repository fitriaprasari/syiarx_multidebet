<?php

/*
 * @author fitriana.dewi
 * Crontab jalan pada data payroll telah divalidasi dan diotorisasi oleh spv
 */

namespace app\modules\multidebet\commands;

use yii\console\Controller;
use app\modules\multidebet\models\PayrollUploadDetail;
use app\modules\multidebet\models\PayrollUploadMaster;
use app\modules\multidebet\models\Parameterpayroll;
use DateTime;
use app\models\User;
use app\modules\multidebet\models\Payrollwsclient;

class PayprosesController extends Controller {

    //status FT
    const ONPROCESS = 'ONPROCESS';
    const VALID = 'SUCCESS';
    const FAILED = 'FAILED';

    public function actionFtproses()
    {
        $tgl_crontab = date('Y-m-d');
        $jam_crontab = date('H:i:s');

        echo "===================================================================================\n";
        echo "[" . $tgl_crontab . "] [" . $jam_crontab . "] Proses Eksekusi Payroll \n";
        echo "==================================================================================\n\n";

        $modelfiles = PayrollUploadMaster::getDataMasterAuth();
        $countfile = count($modelfiles);
        if ($countfile > 0)
        {
            foreach ($modelfiles as $file)
            {
                $tm_exec = strtotime($file['date_exec'] . ' ' . $file['time_exec']);
                $tm_now = strtotime(date('Y-m-d H:i:s'));
                if ($tm_exec <= $tm_now)
                {
                    //update status eksekusi menjadi on proses
                    $exec_stat = "ONPROCESS";
                    PayrollUploadMaster::updateStartExec($file,$exec_stat);
                    echo "[" . $tgl_crontab . "] [" . date('H:i:s') . "]  " . "[" . $file['nama_file_upload'] . "] : START\n\n";

                    $nama_file_upload = $file['nama_file_upload'];
                    $kode_parameter = $file['kode_parameter'];
                    $ftsuccess = 0;
                    $dateprocess = 'null';

                    $modelParam = Parameterpayroll::find()
                            ->where(['kode_parameter' => $kode_parameter])
                            ->one();

                    //get isi data master
                    $modeldetails = PayrollUploadDetail::searchOnly($nama_file_upload);
                    $countdetail = count($modeldetails);
                    if ($countdetail != 0)
                    {
                        $sumPay = PayrollUploadDetail::sumPay($file['nama_file_process']);
                        
//                        if($modelParam->rekening_biaya == "N"){
                            foreach ($modeldetails as $modeldetail)
                            {
                                //proses FT
                                $syiarws_ft = new Payrollwsclient();
                                $msg = $syiarws_ft->pindahBukuPayrollMD($modeldetail);
//                                var_dump
                                echo "[" . $tgl_crontab . "] [" . date('H:i:s') . "]" .
                                $msg['nama_file'] . "   " . $msg['id'] . "                     " .
                                $msg['ft_stat'] . "   " . $msg['ft_msg'] . "\n";

                                //update detail data terkait FT
                                PayrollUploadDetail::FtRespond($msg, $modeldetail);

                                if ($msg['ft_stat'] == "FT Berhasil")
                                {
                                    $ftsuccess = $ftsuccess + 1;
                                }
                                else
                                {
                                    $ftsuccess;
                                }
                            }  
//                        }
                        
                            //update status master data
                            if ($ftsuccess == ($countdetail))
                            {
                                $exec_stat = 'Eksekusi selesai. Seluruh FT berhasil';
                            }
                            else
                            {
                                $exec_stat = 'Eksekusi selesai. Terdapat gagal FT';
                            }
                            $date_process = $msg['date_process'];
                            PayrollUploadMaster::updateStatExec($modeldetail, $exec_stat, $date_process);
//                }   
                        }
                        echo "\n";
                        echo "[" . $tgl_crontab . "] [" . date('H:i:s') . "]  " . "[" . $file['nama_file_upload'] . "] : DONE\n\n";
                    }
                    else
                    {
                        echo "[" . $tgl_crontab . "] [" . date('H:i:s') . "]" . "     " .
                        "[" . $file['nama_file_upload'] . "]" . "         " .
                        "Belum memasuki waktu eksekusi \n";
                    }
//                }
            }
        }
        else
        {
            echo "[" . $tgl_crontab . "] [" . $jam_crontab . "]" . "     " .
            "Tidak ada data payroll ditemukan \n";
        }
    }

}
