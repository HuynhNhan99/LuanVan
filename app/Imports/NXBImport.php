<?php

namespace App\Imports;

use App\Models\NXB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SachImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new NXB([
           'ten_nxb' => $row['Ten_nxb']
        ]);
    }
}
