<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NXBController extends Controller
{   
    public function CheckLogin(){
        $ad_id =Session::get('id_admin');
        if($ad_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('addmin')->send();
        }
    }
    public function List_nxb(){
        $list_nxb= DB::table('nxb')->get();
        $data_nxb=view('admin.quanly.nxb.nxb')->with('list_nxb',$list_nxb);
        return view('admin.index')->with('admin.quanly.nxb.nxb',$data_nxb);
    }
    public function add_nxb(Request $request){
        $data = array();
        $data['ten_nxb']= $request->ten_nxb;
        DB::table('nxb')->insert($data);
        Session::put('message','Thêm nhà xuất bản thành công!');
        return Redirect::to('/list-nxb');
    }
    public function Delete_nxb($nxb_id){
        DB::table('nxb')->where('id_nxb',$nxb_id)->delete();
        Session::put('message','Đã xóa thành công!');
        return Redirect::to('/list-nxb');
    }
    public function Edit_nxb($nxb_id){
        $edit_nxb= DB::table('nxb')->where('id_nxb',$nxb_id)->get();
        $data_nxb= view('admin.quanly.nxb.edit')->with('edit_nxb',$edit_nxb);
        return view('admin.index')->with('admin.quanly.nxb.edit',$data_nxb);
    }
    public function Update_nxb(Request $request, $nxb_id){
        $data = array();
        $data['ten_nxb']= $request->ten_nxb;
        DB::table('nxb')->where('id_nxb',$nxb_id)->update($data);
        return Redirect::to('/list-nxb');
    }
}
