<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class DauSachController extends Controller
{
    public function CheckLogin(){
        $ad_id =Session::get('id_admin');
        if($ad_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('addmin')->send();
        }
    }
    public function List_sach(){
        $this->CheckLogin();
        $id_ncc=Session::get('id_ncc');
        $list_sach= DB::table('dausach')->paginate(5);
        $data_sach=view('admin.quanly.sach.list')->with('list_sach',$list_sach);
        return view('admin.index')->with('admin.quanly.sach.list',$data_sach);
    }
    public function Add_sach(){
        $this->CheckLogin();
        $list_nxb= DB::table('nxb')->get();
        $list_theloai= DB::table('theloai')->get();
        $list_tacgia= DB::table('tacgia')->get();
        $list_ncc= DB::table('nhacungcap')->get();
        return view('admin.quanly.sach.add')->with('list_nxb',$list_nxb)->with('list_theloai',$list_theloai)->with('list_tacgia',$list_tacgia)->with('list_ncc',$list_ncc);
    }
    public function Save_sach(Request $request){
        $this->CheckLogin();
        $data = array();
        $data['ten_sach'] = $request->ten_sach;
        $data['gia_sach'] = $request->gia_sach;
        $data['mo_ta'] = $request->mo_ta;
        $data['so_trang'] = $request->so_trang;
        $data['chieu_dai'] = $request->chieu_dai;
        $data['chieu_rong'] = $request->chieu_rong;
        $data['ngon_ngu'] = $request->ngon_ngu;
        $data['id_ncc'] = $request->id_ncc;
        $data['id_nxb'] = $request->id_nxb;
        $data['id_tg'] = $request->id_tg;
        $data['id_tl'] = $request->id_tl;
        $data['ngay_nhap'] = now();
        $get_image = $request->file('hinh_anh');
        if($get_image){
            $new_image = $get_image->getClientOriginalName();
            $get_image->move('public/uploads/anhsach',$new_image);
            $data['hinh_anh'] = $new_image;
            $sach_id=DB::table('dausach')->insertGetId($data);
            $data_i = array();
            $data_i['id_sach']=$sach_id;
            $data_i['sl_nhap'] = $request->sl_nhap;
            $data_i['ngay_nhap_hang'] = now();
            DB::table('ngaynhaphang')->insert($data_i);
            return Redirect::to('/add-sach');
            if($request->file('fhinh_anh')){
                $data_i = array();
                foreach ($request->file('fhinh_anh') as $image){
                        $data_i['id_sach']=$sach_id;
                        $data_i['ten_ha'] = $image->getClientOriginalName();
                        $image->move('public/uploads/anhsach',$image->getClientOriginalName());
                        DB::table('hinhanh')->insert($data_i);
                }
                return Redirect::to('/add-sach');
            }

            return Redirect::to('/add-sach');
        }
    }
    public function Delete_sach($sach_id){
        DB::table('dausach')->where('id_sach',$sach_id)->delete();
        Session::put('message','Đã xóa thành công!');
        return Redirect::to('/list-sach');
    }
    public function Edit_sach($sach_id){
        $edit_sach= DB::table('dausach')
        ->join('tacgia','dausach.id_tg','=','tacgia.id_tg')
        ->join('nxb','dausach.id_nxb','=','nxb.id_nxb')
        ->join('theloai','dausach.id_tl','=','dausach.id_tl')
        ->where('id_sach',$sach_id)->get();
        $data_sach= view('admin.quanly.sach.edit')->with('edit_sach',$edit_sach);
        return view('admin.index')->with('admin.quanly.sach.edit',$data_sach);
    }
   
    public function Update_nxb(Request $request, $nxb_id){
        $data = array();
        $data['ten_nxb']= $request->ten_nxb;
        DB::table('nxb')->where('id_nxb',$nxb_id)->update($data);
        return Redirect::to('/list-nxb');
    }
    

}
