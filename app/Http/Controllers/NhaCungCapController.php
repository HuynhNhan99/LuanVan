<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NhaCungCapController extends Controller
{
    public function CheckLogin(){
        $ad_id =Session::get('id_admin');
        if($ad_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('addmin')->send();
        }
    }
    public function List_ncc(){
        $list_ncc= DB::table('nhacungcap')->get();
        $data_ncc=view('admin.quanly.nhacungcap.nhacungcap')->with('list_ncc',$list_ncc);
        return view('admin.index')->with('admin.quanly.nhacungcap.nhacungcap',$data_ncc);
    }
    public function add_ncc(Request $request){
        $data = array();
        $data['ten_ncc']= $request->ten_ncc;
        $data['sdt_ncc']= $request->sdt_ncc;
        $data['email_ncc']= $request->email_ncc;
        $data['diachi_ncc']= $request->diachi_ncc;
        DB::table('nhacungcap')->insert($data);
        //Session::put('message','Thêm nhà xuất bản thành công!');
        return Redirect::to('addmin/list-ncc');
    }
    public function Delete_ncc($ncc_id){
        DB::table('nhacungcap')->where('id_ncc',$ncc_id)->delete();
        //Session::put('message','Đã xóa thành công!');
        return Redirect::to('addmin/list-ncc');
    }
    public function Edit_ncc($ncc_id){
        $edit_ncc= DB::table('nhacungcap')->where('id_ncc',$ncc_id)->first();
        $data_ncc= view('admin.quanly.nhacungcap.edit')->with('edit_ncc',$edit_ncc);
        return view('admin.index')->with('admin.quanly.nhacungcap.edit',$data_ncc);
    }
    public function Update_ncc(Request $request, $ncc_id){
        $data = array();
        $data['ten_ncc']= $request->ten_ncc;
        $data['sdt_ncc']= $request->sdt_ncc;
        $data['email_ncc']= $request->email_ncc;
        $data['diachi_ncc']= $request->diachi_ncc;
        DB::table('nhacungcap')->where('id_ncc',$ncc_id)->update($data);
        return Redirect::to('addmin/list-ncc');
    }
    public function tim_ncc(Request $request)
    {
        $list_ncc = DB::table('nhacungcap')
            ->where('ten_ncc', 'like', '%' . $request->timkiem . '%')
            ->get();
        return view('admin.quanly.nhacungcap.timkiem')->with('list_ncc',$list_ncc);
    }
}
