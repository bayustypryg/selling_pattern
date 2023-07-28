<?php

namespace App\Imports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $excelSerialNumber = $row['trx_dt'];
        // Menghitung tanggal berdasarkan format serial Excel untuk Windows (dari 1 Januari 1900)
        $unixTimestamp = ($excelSerialNumber - 25569) * 86400;

        // Membuat objek DateTime dengan timestamp yang dihitung
        $date = new \DateTime("@$unixTimestamp");

        // Format tanggal yang diinginkan (misalnya: d/m/Y untuk format 'tanggal-bulan-tahun')
        $formattedDate = $date->format('Y-m-d');
        return new Transaction([
            'user_id'       =>  Auth::user()->id,
            'trx_dt'        =>  $formattedDate,
            'cif'           =>  $row['cif'],
            'net_amt'       =>  $row['net_amt'],
            'product_nm'    =>  $row['product_nm'],
            'trx_type'      =>  $row['trx_type'],
            'fee_amt'       =>  $row['fee_amt'],
            'app_source'    =>  $row['app_source'],
            'product_type'  =>  $row['product_type'],
            'curr_cd'       =>  $row['curr_cd'],
        ]);
    }
}
