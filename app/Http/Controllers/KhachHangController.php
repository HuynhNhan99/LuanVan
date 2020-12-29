<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ThanhPho;
use Laravel\Socialite\Facades\Socialite;

class KhachHangController extends Controller
{
    public function CheckLoginKH()
    {
        $ad_id = Session::get('id_kh');
        if ($ad_id) {
            return Redirect::to('/');
        } else {
            return Redirect::to('dangnhap-kh')->send();
        }
    }
    public function index()
    {
        $this->CheckLogin();
        return view('admin.dashboard');
    }
    public function Dangki()
    {
        $thanhpho = ThanhPho::orderby('matp', 'ASC')->get();
        return view('home.Auth.dangki')->with('thanhpho', $thanhpho);
    }
    public function dangki_kh(Request $request)
    {
        $validatedData = $request->validate(
            [
                'password' => 'required|min:8',
                'sdt_kh' => 'min:10|numeric',
                'password_confirm' => 'same:password'

            ],
            [
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự !',
                'sdt_kh.numeric' => 'Số điện thoại phải là số!',
                'sdt_kh.min' => 'Số điện thoại phải ít nhất 10 số!',
                'password_confirm.same' => 'Mật khẩu không trùng !',
            ]
        );
        if ($validatedData) {
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
    public function dangnhap_kh(Request $request)
    {

        $validatedData = $request->validate(
            [
                'name' => 'required|string',
                'password' => 'required|min:8',
            ],
            [
                'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự !',
                'name.required' => 'Username không được để trống !',
                'password.required' => 'Mật khẩu không được để trống !'
            ]
        );
        $name = $request->name;
        $password = md5($request->password);
        $result =  DB::table('khachhang')->where('name', $name)->where('password', $password)->first();
        if ($validatedData) {

            if ($result) {
                Session::put('ten_kh', $result->ten_kh);
                Session::put('id_kh', $result->id_kh);
                return Redirect::to('/');
            } else {
                Session::put('message', 'Mật khẩu hoặc tại khoài bị sai. Vui lòng nhập lại!!!');
                return Redirect::to('/dangnhap-kh');
            }
        }
    }
    public function Dangnhap()
    {
        return view('home.Auth.Login');
    }

    public function dangxuat_kh()
    {
        Session::put('ten_kh', null);
        Session::put('name', null);
        Session::put('id_kh', null);
        Session::put('message', null);
        return Redirect::to('/');
    }
    public function danh_gia(Request $request)
    {
        $data = array();
        $data['diem_dg'] = $request->diem_dg;
        $data['id_kh'] = Session::get('id_kh');
        $data['id_sach'] = $request->id_sach;
        $data['noi_dung'] = $request->noi_dung;
        $data['ngay_dg'] = now();
        DB::table('danhgia')->insert($data);
        return $data;
    }
//tai khoan của tôi
    public function tai_khoan()
    {
        $khachhang = DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        if ($khachhang) {
            $array_kh = [
                "ten_kh" => $khachhang->ten_kh,
                "gioi_tinh" => $khachhang->gioi_tinh,
                "sdt_kh" => $khachhang->sdt_kh,
                "diachi_kh" => $khachhang->diachi_kh,
                "email_kh" => $khachhang->email_kh,
                "tenxa" => $khachhang->tenxa,
                "tenqh" => $khachhang->tenqh,
                "tentp" => $khachhang->tentp,
            ];
        } else {
            $khachhang = DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
                ->first();
            $array_kh = [
                "ten_kh" => $khachhang->ten_kh,
                "gioi_tinh" => $khachhang->gioi_tinh,
                "sdt_kh" => $khachhang->sdt_kh,
                "diachi_kh" => $khachhang->diachi_kh,
                "email_kh" => $khachhang->email_kh,
                "tenxa" => null,
                "tenqh" => null,
                "tentp" => null,
            ];
        }

        $thanhpho = ThanhPho::orderby('matp', 'ASC')->get();
        return view('home.Auth.thongtin')->with('thanhpho', $thanhpho)->with('kh', $array_kh);
    }

//admin quản lý khách hàng
    public function list_kh()
    {
        $kh = DB::table('khachhang')->orderby('id_kh', 'ASC')->get();
        return view('admin.quanly.khachhang.list')->with('khachhang', $kh);
    }
    public function tim_kh(Request $request)
    {
        $kh = DB::table('khachhang')
            ->where('ten_kh', 'like', '%' . $request->timkiem . '%')
            ->get();
        return view('admin.quanly.khachhang.timkiem')->with('khachhang', $kh);
    }
    public function Delete_khachhang($kh_id)
    {
        DB::table('khachhang')->where('id_kh', $kh_id)->delete();
        Session::put('message', 'Đã xóa thành công!');
        return Redirect::to('/khach-hang');
    }

//quản lý đánh giá
    public function list_danhgia()
    {
        $dg = DB::table('danhgia')
            ->join('khachhang', 'danhgia.id_kh', '=', 'khachhang.id_kh')
            ->join('dausach', 'danhgia.id_sach', '=', 'dausach.id_sach')
            ->get();
        return view('admin.quanly.Danhgia.list')->with('danhgia', $dg);
    }
    public function ql_danhgia(Request $request)
    {
        $data = array();
        if ($request->get('tt') == 0) {
            $data['tt'] = 1;
        } else if ($request->get('tt') == 1) {
            $data['tt'] = 0;
        }
        DB::table('danhgia')->where('id_dg', $request->get('id_dg'))
            ->update($data);
        return Redirect::to('/list-danhgia');
    }
    public function loc_dg(Request $request)
    {
            $dg = DB::table('danhgia')
            ->join('khachhang', 'danhgia.id_kh', '=', 'khachhang.id_kh')
            ->join('dausach', 'danhgia.id_sach', '=', 'dausach.id_sach')
            ->where('khachhang.ten_kh', 'like', '%' . $request->timkiem . '%')
            ->orwhere('danhgia.diem_dg', 'like', '%' . $request->timkiem . '%')
            ->orwhere('danhgia.noi_dung', 'like', '%' . $request->timkiem . '%')
            ->get();

        return view('admin.quanly.Donhang.locdh')->with('donhang', $dh);
    }
//đổi mật khẩu
    public function doi_mk(Request $request)
    {

        $khachhang = DB::table('khachhang')->where('id_kh', Session::get('id_kh'))->first();

        if ($request->check_mk) {
            if (md5($request->password_ht) == $khachhang->password) {
                $validatedData = $request->validate(
                    [
                        'password' => 'required|min:8',
                        'password_confirm' => 'same:password'
                    ],
                    [
                        'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự !',
                        'password_confirm.same' => 'Mật khẩu không trùng !',
                    ]
                );
                if ($validatedData) {
                    $data = array();
                    $data['ten_kh'] = $request->ten_kh;
                    $data['gioi_tinh'] = $request->gioi_tinh;
                    $data['sdt_kh'] = $request->sdt_kh;
                    $data['email_kh'] = $request->email_kh;
                    $data['password'] = md5($request->password);
                }
            } else {
                dd("sai");
            }
        } else {
            $data = array();
            $data['ten_kh'] = $request->ten_kh;
            $data['gioi_tinh'] = $request->gioi_tinh;
            $data['sdt_kh'] = $request->sdt_kh;
            $data['email_kh'] = $request->email_kh;
        }
        DB::table('khachhang')->where('id_kh', Session::get('id_kh'))->update($data);
        return Redirect::back();
    }
    public function redirect_FB()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_FB()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return Redirect::to('/dangnhap-kh');
        }
        $result = DB::table('khachhang')->where('email_kh', $user->email)->first();
        if ($result) {
            Session::put('ten_kh', $result->ten_kh);
            Session::put('id_kh', $result->id_kh);
            return Redirect::to('/');
        } else {
            $data = array();
            $data['ten_kh'] = $user->name;
            $data['gioi_tinh'] = 3;
            $data['email_kh'] = $user->amail;
            $data['facebook_id'] = $user->id;
            $kh_id = DB::table('khachhang')->insertGetId($data);
            Session::put('ten_kh', $user->getName());
            Session::put('id_kh', $kh_id);
            return Redirect::to('/');
        }
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return Redirect::to('/dangnhap-kh');
        }
        $result = DB::table('khachhang')->where('email_kh', $user->getEmail())->first();

        if ($result) {
            Session::put('ten_kh', $result->ten_kh);
            Session::put('id_kh', $result->id_kh);
            return Redirect::to('/');
        } else {
            $data = array();
            $data['ten_kh'] = $user->getName();
            $data['gioi_tinh'] = 3;
            $data['email_kh'] = $user->getEmail();
            $data['google_id'] = $user->getId();
            $kh_id = DB::table('khachhang')->insertGetId($data);
            Session::put('ten_kh', $user->getName());
            Session::put('id_kh', $kh_id);
            return Redirect::to('/');
        }
    }

    public function python()
    {
        $text="lệnh nào thông qua";
        $result=exec("python D:\python.py $text");
        dd($result);
    }

    public function them_dc(Request $request)
    {
        $this->CheckLoginKH();
        $validatedData = $request->validate(
            [
                'matp' => 'min:1|numeric',
                'maqh' => 'min:1|numeric',
                'maxa' => 'min:1|numeric'
            ],
            [
                'matp.min' => 'Bạn phải chọn Tỉnh/Thành phố !',
                'maqh.min' => 'Bạn phải chọn Quận huyện !',
                'maqh.numeric' => 'Bạn phải chọn Quận huyện !',
                'maxa.numeric' => 'Bạn phải chọn Xã phường/Thị trấn !',
                'maxa.min' => 'Bạn phải chọn Xã phường/Thị trấn !',
            ]
        );
        if ($validatedData) {
            $data = array();
            $data['diachi_kh'] = $request->diachi_kh;
            $data['matp'] = $request->matp;
            $data['maqh'] = $request->maqh;
            $data['maxa'] = $request->maxa;
            DB::table('khachhang')->where('id_kh', Session::get('id_kh'))->update($data);
            return Redirect::to('/tai-khoan-cua-toi');
        }
    }
}
