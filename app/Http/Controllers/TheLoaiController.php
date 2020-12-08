<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TheLoaiController extends Controller
{
    public function List_theloai(){
        $list_theloai= DB::table('theloai')->get();
        $data_theloai=view('admin.quanly.theloai.theloai')->with('list_theloai',$list_theloai);
        return view('admin.index')->with('admin.quanly.nxb.nxb',$data_theloai);
    }
    public function List_nxb(){
        $list_nxb= DB::table('nxb')->get();
        $data_nxb=view('admin.quanly.nxb.nxb')->with('list_nxb',$list_nxb);
        return view('admin.index')->with('admin.quanly.nxb.nxb',$data_nxb);
    }
    public function add_theloai(Request $request){
        $data = array();
        $data['ten_tl']= $request->ten_tl;
        DB::table('theloai')->insert($data);
        Session::put('message','Thêm thể loại thành công!');
        return Redirect::to('/list-theloai');
    }

    public function Delete_theloai($theloai_id){
        DB::table('theloai')->where('id_tl',$theloai_id)->delete();
        Session::put('message','Đã xóa thành công!');
        return Redirect::to('/list-theloai');
    }
    public function Edit_theloai($theloai_id){
        $edit_theloai= DB::table('theloai')->where('id_tl',$theloai_id)->get();
        $data_theloai= view('admin.quanly.theloai.edit')->with('edit_theloai',$edit_theloai);
        return view('admin.index')->with('admin.quanly.theloai.edit',$data_theloai);
    }
    public function Update_theloai(Request $request, $theloai_id){
        $data = array();
        $data['ten_tl']= $request->ten_tl;
        DB::table('theloai')->where('id_tl',$theloai_id)->update($data);
        return Redirect::to('/list-theloai');
    }
}
