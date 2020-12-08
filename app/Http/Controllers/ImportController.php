<?php

namespace App\Http\Controllers;

use App\Imports\SachImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ImportController extends Controller
{
    public function import(Request $request){
        $file=$request->file('import_sach')->getRealPath();
        Excel::import(new SachImport, $file);
        return Redirect::to('/list-sach');
}
    
}
