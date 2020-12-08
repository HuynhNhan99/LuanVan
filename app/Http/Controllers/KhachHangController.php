<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ThanhPho;
class KhachHangController extends Controller
{
    public function CheckLoginKH(){
        $ad_id =Session::get('id_kh');
        if($ad_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('dangnhap-kh')->send();
        }
    }
    public function index(){
        $this->CheckLogin();
        return view('admin.dashboard');
    }
    public function Dangki(){
        $thanhpho = ThanhPho::orderby('matp','ASC')->get();
        return view('home.Auth.dangki')->with('thanhpho',$thanhpho);
    }
    public function dangki_kh(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|min:8',
            'sdt_kh' => 'min:10|numeric'
        ],
        [
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự !',
            'sdt_kh.numeric' => 'Số điện thoại phải là số!'
            
        ]);
        if($validatedData){
            $data = array();
            $data['ten_kh'] = $request->ten_kh;
            $data['gioi_tinh'] = $request->gioi_tinh;
            $data['sdt_kh'] = $request->sdt_kh;
            $data['diachi_kh'] = $request->diachi_kh;
            $data['email_kh'] = $request->email_kh;
            $data['name'] = $request->name;
            $data['password'] =  md5($request->password);
            $data['matp'] = $request->matp;
            $data['maqh'] = $request->maqh;
            $data['maxa'] = $request->maxa;
            DB::table('khachhang')->insert($data);
            return Redirect::to('/dangnhap-kh'); 
        }
    }
    public function dangnhap_kh(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:8',
        ],
        [
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự !',
            'name.required' =>'Username không được để trống !',
            'password.required' =>'Mật khẩu không được để trống !'
        ]);
        $name = $request->name;
        $password = md5($request->password);
        $result =  DB::table('khachhang')->where('name',$name)->where('password',$password)->first();
        if($validatedData){
            
        if($result){
            Session::put('ten_kh',$result->ten_kh);
            Session::put('name',$result->name);
            Session::put('id_kh',$result->id_kh);
            return Redirect::to('/');
        }else{
            Session::put('message','Mật khẩu hoặc tại khoài bị sai. Vui lòng nhập lại!!!');
            return Redirect::to('/dangnhap-kh');
        }}

    }
    public function Dangnhap(){
        return view('home.Auth.Login');
    }

    public function dangxuat_kh(){
        Session::put('ten_kh',null);
        Session::put('name',null);
        Session::put('id_kh',null);
        Session::put('message',null);
        return Redirect::to('/');
    }
    public function danh_gia(Request $request){
        $data = array();
        $data['diem_dg'] = $request->diem_dg;
        $data['id_kh'] = Session::get('id_kh');
        $data['id_sach'] = $request->id_sach;
        $data['noi_dung']= $request->noi_dung;
        $data['ngay_dg'] = now();
        DB::table('danhgia')->insert($data);
        return $data; 
    }

    //admin
    public function list_kh(){
        $kh = DB::table('khachhang')->orderby('id_kh','ASC')->get();
        return view('admin.quanly.khachhang.list')->with('khachhang',$kh);
    }
    public function Delete_khachhang($kh_id){
        DB::table('khachhang')->where('id_kh',$kh_id)->delete();
        Session::put('message','Đã xóa thành công!');
        return Redirect::to('/khach-hang');
    }
    public function list_danhgia(){
        $dg=DB::table('danhgia')
        ->join('khachhang', 'danhgia.id_kh', '=', 'khachhang.id_kh')
        ->join('dausach', 'danhgia.id_sach', '=', 'dausach.id_sach')
        ->get();
        return view('admin.quanly.Danhgia.list')->with('danhgia',$dg);
    }
}
