<?php

namespace App\Imports;

use App\Models\DauSach;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SachImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DauSach([
           'ten_sach'   => $row['ten_sach'],
           'gia_sach'   => $row['gia_sach'],
           'mo_ta'      => $row['tom_tat'],
           'so_trang'   => $row['so_trang'],
           'chieu_dai'  => $row['chieu_dai'],
           'chieu_rong' => $row['chieu_rong'],
           'hinh_anh'   => $row['hinh_anh'],
           'id_ncc'     => $row['id_ncc'],
           'id_nxb'     => $row['id_nxb'],
           'id_tg'      => $row['id_tg'],
           'id_tl'      => $row['id_tl'],
           'ngay_nhap'  => now()
        ]);
    }
}
