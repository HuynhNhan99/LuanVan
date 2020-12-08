<?php

namespace App\Exports;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;

class SachExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {   
        $kh= DB::table('dausach')
        ->join('tacgia','dausach.id_tg','=','tacgia.id_tg')
        ->join('nxb','dausach.id_nxb','=','nxb.id_nxb')
        ->join('theloai','dausach.id_tl','=','dausach.id_tl')
        ->orderby('id_sach','ASC')->get();
        return view('admin.export.user')->with('khachhang',$kh);
    }
    
}
