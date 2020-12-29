<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TacGiaController extends Controller
{
    public function List_tacgia(){
        $list_tacgia= DB::table('tacgia')->get();
        $data_tacgia=view('admin.quanly.tacgia.tacgia')->with('list_tacgia',$list_tacgia);
        return view('admin.index')->with('admin.quanly.tacgia.tacgia',$data_tacgia);
    }
    public function List_nxb(){
        $list_nxb= DB::table('nxb')->get();
        $data_nxb=view('admin.quanly.nxb.nxb')->with('list_nxb',$list_nxb);
        return view('admin.index')->with('admin.quanly.nxb.nxb',$data_nxb);
    }
    public function add_tacgia(Request $request){
        $data = array();
        $data['ten_tg']= $request->ten_tg;
        DB::table('tacgia')->insert($data);
        Session::put('message','Thêm tác giả thành công!');
        return Redirect::to('/list-tacgia');
    }
    public function Delete_tacgia($tacgia_id){
        DB::table('tacgia')->where('id_tg',$tacgia_id)->delete();
        Session::put('message','Đã xóa thành công!');
        return Redirect::to('/list-tacgia');
    }
    public function Edit_tacgia($tacgia_id){
        $edit_tacgia= DB::table('tacgia')->where('id_tg',$tacgia_id)->get();
        $data_tacgia= view('admin.quanly.tacgia.edit')->with('edit_tacgia',$edit_tacgia);
        return view('admin.index')->with('admin.quanly.tacgia.edit',$data_tacgia);
    }
    public function Update_tacgia(Request $request, $tacgia_id){
        $data = array();
        $data['ten_tg']= $request->ten_tg;
        DB::table('tacgia')->where('id_tg',$tacgia_id)->update($data);
        return Redirect::to('/list-tacgia');
    }

    public function tim_tacgia(Request $request)
    {
        $list_tacgia = DB::table('tacgia')
            ->where('ten_tg', 'like', '%' . $request->timkiem . '%')
            ->get();
        return view('admin.quanly.tacgia.timkiem')->with('list_tacgia',$list_tacgia);
    }
}
