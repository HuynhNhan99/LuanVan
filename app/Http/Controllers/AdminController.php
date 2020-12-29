<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\Environment\Console;

session_start();


class AdminController extends Controller
{
    public function CheckLogin()
    {
        $ad_id = Session::get('id_admin');
        if ($ad_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('addmin')->send();
        }
    }
    //trang quản lý
    public function index()
    {
        $this->CheckLogin();
        $choxacnhan =  DB::table('donhang')->where('trang_thai', 1)->count();
        $daxacnhan =  DB::table('donhang')->where('trang_thai', 2)->count();
        $danggiao =  DB::table('donhang')->where('trang_thai', 3)->count();
        $dagiao =  DB::table('donhang')->where('trang_thai', 4)->count();
        $dahuy =  DB::table('donhang')->where('trang_thai', 5)->count();
        $tt_dh = [
            $choxacnhan,
            $daxacnhan,
            $danggiao,
            $dagiao,
            $dahuy
        ];
        $doanhthu =  DB::table('donhang')
            ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
            ->groupBy('thang')
            ->get();
        $max =  DB::table('donhang')
            ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
            ->groupBy('thang')
            ->orderBy('tongtien', 'desc')
            ->first();
        $min =  DB::table('donhang')
            ->selectRaw('sum(tong_tien) as tongtien, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam')
            ->groupBy('thang')
            ->orderBy('tongtien', 'asc')
            ->first();
        $khachhang =  DB::table('khachhang')->count();
        $sach =  DB::table('dausach')->count();
        $dh =  DB::table('donhang')->count();
        $ncc =  DB::table('nhacungcap')->count();
        //dd($doanhthu);
        for ($i = 1; $i <= 12; $i++) {
            $total = 0;
            foreach ($doanhthu as $dt) {
                if ($dt->thang == $i) {
                    $total = $dt->tongtien;
                }
            }
            $arr_dt[] = (int)$total;
        }

        //print_r($data);
        return view('admin.dashboard')
            ->with('dh', $dh)
            ->with('ncc', $ncc)
            ->with('sach', $sach)->with('min', $min)->with('max', $max)->with('tt_dh', $tt_dh)->with('kh', $khachhang)->with('dt_thang', json_encode($arr_dt));;
    }

    public function admin()
    {
        return view('admin.Auth.Login');
    }
    public function Login(Request $request)
    {
        $validatedData = $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required|min:8',
            ],
            [
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự'
            ]
        );
        $username = $request->username;
        $password = md5($request->password);
        $result =  DB::table('admin')->where('username', $username)->where('password', $password)->first();
        if ($validatedData) {
            if ($result) {
                Session::put('ten_admin', $result->ten_admin);
                Session::put('id_admin', $result->id);
                return Redirect::to('/dashboard');
            } else {
                Session::put('message', 'Mật khẩu hoặc tại khoài bị sai. Vui lòng nhập lại!!!');
                return Redirect::to('/addmin');
            }
        }
    }

    public function Logout()
    {
        $this->CheckLogin();
        Session::put('ten_admin', null);
        Session::put('id_admin', null);
        return Redirect::to('/addmin');
    }
    public function top_10()
    {
        //sach bán chạy
        if (isset($_GET['thang'])) {
            $top10 =  DB::table('donhang')
                ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach,dausach.ten_sach,dausach.gia_sach ')
                ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
                ->join('dausach', 'ctgiohang.id_sach', '=', 'dausach.id_sach')
                //->where('donhang.trang_thai',4)
                ->groupBy('id_sach', 'thang')
                ->havingRaw('thang=' . $_GET['thang'] . '')
                ->orderBy('soluong', 'desc')
                ->get();
            return view('admin.doanhthu.topsach')->with('top10', $top10);
        } else {
            $month = date("m", strtotime(now()));
            $year = date("Y", strtotime(now()));
            $top10 =  DB::table('donhang')
                ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach,dausach.ten_sach,dausach.gia_sach ')
                ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
                ->join('dausach', 'ctgiohang.id_sach', '=', 'dausach.id_sach')
                //->where('donhang.trang_thai',4)
                ->groupBy('id_sach', 'thang')
                ->havingRaw('thang=' . $month . ' and nam=' . $year . '')
                ->orderBy('soluong', 'desc')
                ->get();
            foreach ($top10 as $key => $sach) {
                $sl_sach[$key] = (int)$sach->soluong;
                $ten_sach[$key] = $sach->ten_sach;
            }

            return view('admin.doanhthu.top10')->with('top10', $top10)->with('sl_sach', $sl_sach)->with('ten_sach', $ten_sach);
        }
    }

    public function dt_thang()
    {
        $doanhthu =  DB::table('donhang')
            ->selectRaw('sum(ctgiohang.so_luong) as soluong, MONTH(ngay_dat) as thang, YEAR(ngay_dat) as nam, ctgiohang.id_sach,dausach.ten_sach,dausach.gia_sach ')
            ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
            ->join('dausach', 'ctgiohang.id_sach', '=', 'dausach.id_sach')
            ->groupBy('thang', 'ctgiohang.id_sach')
            ->orderByDesc('soluong')
            ->get();
        //dd($doanhthu);

        return view('admin.doanhthu.dt_thang')->with('doanhthu', $doanhthu);
    }
    //Quản lý kho
    public function quanly_kho()
    {
        $list_kho =  DB::table('dausach')
            ->selectRaw('sum(sl_nhap) as sl_nhap, dausach.ten_sach, dausach.hinh_anh, dausach.gia_sach, dausach.id_sach')
            ->join('ngaynhaphang', 'dausach.id_sach', '=', 'ngaynhaphang.id_sach')
            ->groupBy('dausach.id_sach')
            ->orderByDesc('sl_nhap')
            ->get();
        $array_sach = [];
        foreach ($list_kho as $key => $sach) {
            $sl_ban =  DB::table('donhang')
                ->selectRaw('sum(ctgiohang.so_luong) as soluong, dausach.id_sach')
                ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
                ->join('dausach', 'ctgiohang.id_sach', '=', 'dausach.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->groupBy('dausach.id_sach')
                ->orderBy('soluong', 'desc')
                ->first();

            if ($sl_ban) {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "sl_nhap" => $sach->sl_nhap,
                    "sl_ton" => $sach->sl_nhap - $sl_ban->soluong
                ];
            } else {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "sl_nhap" => $sach->sl_nhap,
                    "sl_ton" => $sach->sl_nhap
                ];
            }
        }
        return view('admin.quanly.khosach.list')->with('list_kho', $array_sach);
    }
    public function them_kho(Request $request)
    {
        $data = array();
        $data['id_sach'] = $request->id_sach;
        $data['ngay_nhap_hang'] = now();
        $data['sl_nhap'] = $request->sl_nhap;
        DB::table('ngaynhaphang')->insert($data);
        return Redirect::to('/quanly-kho');
    }
    public function tim_kho(Request $request)
    {
        $list_kho =  DB::table('dausach')
            ->selectRaw('sum(sl_nhap) as sl_nhap, dausach.ten_sach, dausach.hinh_anh, dausach.gia_sach, dausach.id_sach')
            ->join('ngaynhaphang', 'dausach.id_sach', '=', 'ngaynhaphang.id_sach')
            ->where('dausach.ten_sach', 'like', '%' . $request->timkiem . '%')
            ->orWhere('dausach.mo_ta', 'like', '%' . $request->timkiem . '%')
            ->orWhere('sl_nhap', 'like', '%' . $request->timkiem . '%')
            ->groupBy('dausach.id_sach')
            ->orderByDesc('sl_nhap')
            ->get();
        $array_sach = [];
        foreach ($list_kho as $key => $sach) {
            $sl_ban =  DB::table('donhang')
                ->selectRaw('sum(ctgiohang.so_luong) as soluong, dausach.id_sach')
                ->join('ctgiohang', 'donhang.id_dh', '=', 'ctgiohang.id_dh')
                ->join('dausach', 'ctgiohang.id_sach', '=', 'dausach.id_sach')
                ->where('dausach.id_sach', $sach->id_sach)
                ->groupBy('dausach.id_sach')
                ->orderBy('soluong', 'desc')
                ->first();

            if ($sl_ban) {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "sl_nhap" => $sach->sl_nhap,
                    "sl_ton" => $sach->sl_nhap - $sl_ban->soluong
                ];
            } else {
                $array_sach[$key] = [
                    "id_sach" => $sach->id_sach,
                    "ten_sach" => $sach->ten_sach,
                    "hinh_anh" => $sach->hinh_anh,
                    "gia_sach" => $sach->gia_sach,
                    "sl_nhap" => $sach->sl_nhap,
                    "sl_ton" => $sach->sl_nhap
                ];
            }
        }

        return view('admin.quanly.khosach.timkiem')->with('list_kho', $array_sach);
    }
    public function ct_kho($id_sach)
    {
        $ct_kho =  DB::table('ngaynhaphang')
            ->where('id_sach', $id_sach)
            ->orderBy('ngay_nhap_hang', 'ASC')
            ->get();
        $tensach =  DB::table('dausach')
            ->where('id_sach', $id_sach)
            ->first();
        return view('admin.quanly.khosach.chitietkho')->with('ct_kho', $ct_kho)->with('tensach', $tensach);
    }
}
