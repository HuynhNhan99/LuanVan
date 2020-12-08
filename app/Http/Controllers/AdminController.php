<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();


class AdminController extends Controller
{   
    public function CheckLogin(){
        $ad_id =Session::get('id_admin');
        if($ad_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('addmin')->send();
        }
    }
    public function index(){
        $this->CheckLogin();
        $choxacnhan=  DB::table('donhang')->where('trang_thai',1) ->count();
        $daxacnhan=  DB::table('donhang')->where('trang_thai',2) ->count();
        $danggiao=  DB::table('donhang')->where('trang_thai',3) ->count();
        $dagiao=  DB::table('donhang')->where('trang_thai',4) ->count();
        $dahuy=  DB::table('donhang')->where('trang_thai',5) ->count();
        $tt_dh=[
            $choxacnhan,
            $daxacnhan,
            $danggiao,
            $dagiao,
            $dahuy
        ];
        $doanhthu=  DB::table('donhang')
        ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
        ->groupBy('thang')
        ->get();
        $max=  DB::table('donhang')
        ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
        ->groupBy('thang')
        ->orderBy('tongtien', 'desc')
        ->first();
        $min=  DB::table('donhang')
        ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
        ->groupBy('thang')
        ->orderBy('tongtien', 'asc')
        ->first();
        $khachhang=  DB::table('khachhang')->count();
        $sach=  DB::table('dausach')->count();
        $dh=  DB::table('donhang')->count();
        $ncc=  DB::table('nhacungcap')->count();
        //dd($doanhthu);
        for($i=1;$i<=12;$i++){
            $total=0;
            foreach($doanhthu as $dt){
                if($dt->thang == $i){
                    $total=$dt->tongtien;
                }
            }
            $arr_dt[]=(int)$total;
        }
        
        //print_r($data);
        return view('admin.dashboard')
        ->with('dh',$dh)
        ->with('ncc',$ncc)
        ->with('sach',$sach)->with('min',$min)->with('max',$max)->with('tt_dh',$tt_dh)->with('kh',$khachhang)->with('dt_thang',json_encode($arr_dt));
;
    }
   
    public function admin(){
        return view('admin.Auth.Login');
    }
    public function Login(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:8',
        ],
        [
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự'
        ]);
        $username = $request->username;
        $password = md5($request->password);
        $result =  DB::table('admin')->where('username',$username)->where('password',$password)->first();
        if($validatedData){
        if($result){
            Session::put('ten_admin',$result->ten_admin);
            Session::put('id_admin',$result->id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tại khoài bị sai. Vui lòng nhập lại!!!');
            return Redirect::to('/addmin');
        }}

    }

    public function Logout(){
        $this->CheckLogin();
        Session::put('ten_admin',null);
        Session::put('id_admin',null);
        return Redirect::to('/addmin');

    }
    public function top_10(){
        //sach bán chạy
        $top10=  DB::table('donhang')
        ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach,dausach.ten_sach,dausach.gia_sach ')
        ->join('ctgiohang','donhang.id_dh','=','ctgiohang.id_dh') 
        ->join('dausach','ctgiohang.id_sach','=','dausach.id_sach') 
        //->where('donhang.trang_thai',4)
        ->groupBy('id_sach','thang')
        ->havingRaw('thang = 11')
        ->orderBy('soluong', 'desc')
        ->get();
        return view('admin.doanhthu.top10')->with('top10',$top10);

    }
    public function dt_thang(){
        $doanhthu=  DB::table('donhang')
        ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach,dausach.ten_sach,dausach.gia_sach ')
        ->join('ctgiohang','donhang.id_dh','=','ctgiohang.id_dh') 
        ->join('dausach','ctgiohang.id_sach','=','dausach.id_sach') 
        ->groupBy('thang', 'ctgiohang.id_sach')
        ->orderByDesc('soluong')
        ->get();
        //dd($doanhthu);
        
        return view('admin.doanhthu.dt_thang')->with('doanhthu',$doanhthu);

    }
}
