<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\PhuongXa;
use App\Models\ThanhPho;
use App\Models\QuanHuyen;
use Barryvdh\DomPDF\Facade as PDF;
use SebastianBergmann\Environment\Console;
use Toastr;

class DatHangController extends Controller
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

    public function dathang(Request $request)
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
            $data['sdt_kh'] = $request->sdt_kh;
            $data['diachi_kh'] = $request->diachi_kh;
            $data['matp'] = $request->matp;
            $data['maqh'] = $request->maqh;
            $data['maxa'] = $request->maxa;
            DB::table('khachhang')->where('id_kh', Session::get('id_kh'))->update($data);
            return Redirect::to('/xacnhan-dc');
        }
    }
    public function Update_nxb(Request $request, $nxb_id)
    {
        $data = array();
        $data['ten_nxb'] = $request->ten_nxb;
        DB::table('nxb')->where('id_nxb', $nxb_id)->update($data);
        return Redirect::to('/list-nxb');
    }
    public function xacnhan_dc()
    {
        $khachhang =  DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        $thanhpho = ThanhPho::orderby('matp', 'ASC')->get();
        //dd($khachhang);

        return view('home.dathang.xacnhandc')->with('khachhang', $khachhang)->with('thanhpho', $thanhpho);
    }
    public function dat_hang()
    {
        $thanhtoan =  DB::table('thanhtoan')->get();
        $khachhang =  DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        $phi = DB::table('phivanchuyen')
            ->where('matp', $khachhang->matp)
            ->where('maqh', $khachhang->maqh)
            ->where('maxa', $khachhang->maxa)->first();
        //dd($khachhang);
        if ($phi) {
            Session::put('phiship', $phi->phi_vc);
        } else {
            Session::put('phiship', 30000);
        }
        return view('home.dathang.dathang')->with('thanhtoan', $thanhtoan)->with('khachhang', $khachhang);
    }
    public function thanhtoan(Request $request)
    {
        $khachhang =  DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        $tongtien = Cart::subtotal(0, '.', '');
        $tienship = Session::get('phiship');
        $data_dh = array();
        $data_dh['id_tt'] = $request->id_tt;
        $data_dh['id_kh'] = Session::get('id_kh');
        $data_dh['ngay_dat'] = now();
        $data_dh['tong_tien'] = $tongtien;
        $data_dh['tien_ship'] = $tienship;
        $data_dh['dc_dh'] = $khachhang->diachi_kh . ', ' . $khachhang->tenxa . ', ' . $khachhang->tenqh . ', ' . $khachhang->tentp;
        $data_dh['trang_thai'] = 1;
        $giohang = Cart::content();
        if ($request->id_tt == 2) {
            return Redirect::to('payment');
        }
        $id_dh = DB::table('donhang')->insertGetId($data_dh);
        foreach ($giohang as $ctgiohang) {
            $data_ctdh['id_dh'] = $id_dh;
            $data_ctdh['id_sach'] = $ctgiohang->id;
            $data_ctdh['so_luong'] = $ctgiohang->qty;
            DB::table('ctgiohang')->insert($data_ctdh);
            $sach =  DB::table('dausach')->where('id_sach', $ctgiohang->id)->first();
            $data_sl = array();
            $data_sl['sl_sach'] = $sach->sl_sach - $ctgiohang->qty;
            DB::table('dausach')->where('id_sach', $ctgiohang->id)->update($data_sl);
        }

        Cart::destroy();
        return Redirect::to('/');
    }

    public function thanhtoan_vnpay(Request $request)
    {
        $khachhang =  DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        $url = session('url_prev', '/');
        if ($request->vnp_ResponseCode == "00") {
            $tongtien = Cart::subtotal(0, '.', '');
            $tienship = Session::get('phiship');
            $data_dh = array();
            $data_dh['id_tt'] = 2;
            $data_dh['id_kh'] = Session::get('id_kh');
            $data_dh['ngay_dat'] = now();
            $data_dh['tong_tien'] = $tongtien;
            $data_dh['tien_ship'] = $tienship;
            $data_dh['dc_dh'] = $khachhang->diachi_kh . ', ' . $khachhang->tenxa . ', ' . $khachhang->tenqh . ', ' . $khachhang->tentp;
            $data_dh['trang_thai'] = 1;
            $giohang = Cart::content();
            $id_dh = DB::table('donhang')->insertGetId($data_dh);
            foreach ($giohang as $ctgiohang) {
                $data_ctdh['id_dh'] = $id_dh;
                $data_ctdh['id_sach'] = $ctgiohang->id;
                $data_ctdh['so_luong'] = $ctgiohang->qty;
                DB::table('ctgiohang')->insert($data_ctdh);
            }
            Cart::destroy();
            return Redirect::to('/');
        }
        session()->forget('url_prev');
        return redirect($url)->with('loi', 'Lỗi trong quá trình thanh toán phí dịch vụ');
    }
    public function donhang()
    {
        $dh =  DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->get();
        return view('admin.quanly.Donhang.donhang')->with('donhang', $dh);;
    }
    public function duyet_dh(Request $request, $id_dh)
    {
        $data = array();
        $data['donhang.trang_thai'] = $request->id_tt;
        DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->where('donhang.id_dh', $id_dh)->update($data);
        return  Redirect::to('/all-donhang');
    }
    public function ctdonhang($id_dh)
    {
        $ct_sach = DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->where('donhang.id_dh', $id_dh)
            ->get();

        foreach ($ct_sach as $key => $ctdh) {
            $km =  DB::table('khuyenmai')
                ->join('ctkhuyenmai', 'ctkhuyenmai.id_km', '=', 'khuyenmai.id_km')
                ->join('dausach', 'dausach.id_sach', '=', 'ctkhuyenmai.id_sach')
                ->where('dausach.id_sach', $ctdh->id_sach)
                ->where('khuyenmai.ngay_bat_dau', '<=', $ctdh->ngay_dat)
                ->where('khuyenmai.ngay_ket_thuc', '>=', $ctdh->ngay_dat)
                ->first();
            if ($km) {
                $array_sach[$key] = [
                    "id_sach" => $km->id_sach,
                    "ten_sach" => $km->ten_sach,
                    "hinh_anh" => $km->hinh_anh,
                    "gia_sach" => $km->gia_sach,
                    "so_luong" => $ctdh->so_luong,
                    "phantram_km" => $km->phantram_km,
                ];
            } else {
                $array_sach[$key] = [
                    "id_sach" => $ctdh->id_sach,
                    "ten_sach" => $ctdh->ten_sach,
                    "hinh_anh" => $ctdh->hinh_anh,
                    "gia_sach" => $ctdh->gia_sach,
                    "so_luong" => $ctdh->so_luong,
                    "phantram_km" => 0,
                ];
            }
        }
        $dh =  DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->join('thanhtoan', 'thanhtoan.id_tt', '=', 'donhang.id_tt')
            ->where('donhang.id_dh', $id_dh)->first();
        return view('admin.quanly.Donhang.ctdonhang')->with('ctdonhang', $array_sach)->with('khachhang', $dh);
    }
    public function in_dh($id_dh)
    {
        //sử dụng mảng
        $ctdh = DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->join('ctkhuyenmai', 'ctkhuyenmai.id_sach', '=', 'dausach.id_sach')
            ->join('khuyenmai', 'ctkhuyenmai.id_km', '=', 'khuyenmai.id_km')
            ->where('donhang.id_dh', $id_dh)
            ->get();
        $dh =  DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->join('thanhtoan', 'thanhtoan.id_tt', '=', 'donhang.id_tt')
            ->where('donhang.id_dh', $id_dh)->first();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('
            <style>
                .invoice-title h2,
                .invoice-title h3 {
                    display: inline-block;
                }

                .table>tbody>tr>.no-line {
                    border-top: none;
                }

                .table>thead>tr>.no-line {
                    border-bottom: none;
                }

                .table>tbody>tr>.thick-line {
                    border-top: 2px solid;
                }
                * {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                }
                *{
                    font-family: DejaVu Sans;
                }
                .container {
                    margin-right: auto;
                    margin-left: auto;
                    padding-left: 15px;
                    padding-right: 15px;
                }

                .invoice-title h2,
                .invoice-title h3 {
                    display: inline-block;
                }

                .pull-right {
                    float: right !important;
                }

                h3,
                .h3 {
                    font-size: 24px;
                }

                h1,
                h2,
                h3,
                h4,
                h5,
                h6,
                .h1,
                .h2,
                .h3,
                .h4,
                .h5,
                .h6 {
                    font-weight: 500;
                    line-height: 1.1;
                    color: inherit;
                }

                .panel {
                    margin-bottom: 20px;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                }

                .panel-default>.panel-heading {
                    color: #333;
                    background-color: #f5f5f5;
                    border-color: #ddd;
                }

                .panel-heading {
                    padding: 10px 15px;
                    border-bottom: 1px solid transparent;
                    border-top-right-radius: 3px;
                    border-top-left-radius: 3px;
                }

                .panel-title {
                    margin-top: 0;
                    margin-bottom: 0;
                    font-size: 16px;
                    color: inherit;
                }

                .panel-body {
                    padding: 15px;
                }

                .table {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .table>thead:first-child>tr:first-child>td {
                    border-top: 0;
                }

                .table-condensed>thead>tr>th,
                .table-condensed>tbody>tr>th,
                .table-condensed>tfoot>tr>th,
                .table-condensed>thead>tr>td,
                .table-condensed>tbody>tr>td,
                .table-condensed>tfoot>tr>td {
                    padding: 5px;
                }

                .table>thead>tr>th,
                .table>tbody>tr>th,
                .table>tfoot>tr>th,
                .table>thead>tr>td,
                .table>tbody>tr>td,
                .table>tfoot>tr>td {
                    padding: 8px;
                    line-height: 1.428571429;
                    vertical-align: top;
                    border-top: 1px solid #ddd;
                }

                .table>tbody>tr>.thick-line {
                    border-top: 2px solid;
                }
            </style>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice-title">
                    <strong style="font-size:20px;">HÓA ĐƠN</strong><h3 class="pull-right">Order #' . $id_dh . '</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                            <strong>Thông tin đơn hàng:</strong><br>
                                Tên: ' . $dh->ten_kh . '<br>
                                Số điện thoại: ' . $dh->sdt_kh . '<br>
                                Địa chỉ: ' . $dh->dc_dh . '<br>
                                Email: ' . $dh->email_kh . '<br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Phương thức thanh toán:</strong> ' . $dh->ten_tt . '<br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Ngày đặt:</strong> ' . $dh->ngay_dat . '<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>CHI TIẾT ĐƠN HÀNG</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>Tên sách</strong></td>
                                            <td class="text-center"><strong>Giá sách</strong></td>
                                            <td class="text-center"><strong>Số lượng</strong></td>
                                            <td class="text-right"><strong>Tổng cộng</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                      
                                        <tr>
                                            <td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center"><strong>Tổng tiền:</strong></td>
                                            <td class="thick-line text-right">' . $dh->tong_tien . '</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong> Tiền ship: </strong></td>
                                            <td class="no-line text-right">' . $dh->tien_ship . '</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>Thành tiền: </strong></td>
                                            <td class="no-line text-right">' . $dh->tong_tien . '+' . $dh->tien_ship . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ');
        return $pdf->stream();
        //     return view('admin.quanly.Donhang.hoadon');
        //     $pdf = app('dompdf.wrapper');
        // $pdf->loadView('admin.quanly.Donhang.hoadon');
        // $fileName = $id_dh;
        // return $pdf->stream('HOADON_'.$fileName.'.pdf');
    }
    public function innd_dh($id_dh)
    {
        return $id_dh;
    }
    public function loc_dh(Request $request)
    {
        if ($request->timkiem) {
            $dh = DB::table('donhang')
                ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                ->where('khachhang.ten_kh', 'like', '%' . $request->timkiem . '%')
                ->get();
        } else {
            if ($request->tt > 0 && $request->sx > 0) {
                if ($request->sx == 1) {
                    $dh = DB::table('donhang')
                        ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                        ->where('trang_thai', $request->tt)
                        ->orderby('ngay_dat', 'DESC')->get();
                } elseif ($request->sx == 2) {
                    $dh = DB::table('donhang')
                        ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                        ->where('trang_thai', $request->tt)
                        ->orderby('tong_tien', 'DESC')->get();
                } else {
                    $dh = DB::table('donhang')
                        ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                        ->where('trang_thai', $request->tt)
                        ->orderby('trang_thai', 'DESC')->get();
                }
            } elseif ($request->sx > 0 && $request->tt == 0) {
                if ($request->sx == 1) {
                    $dh = DB::table('donhang')
                        ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                        ->orderby('ngay_dat', 'DESC')->get();
                } elseif ($request->sx == 2) {
                    $dh = DB::table('donhang')
                        ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                        ->orderby('tong_tien', 'DESC')->get();
                } else {
                    $dh = DB::table('donhang')
                        ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                        ->orderby('trang_thai', 'ASC')->get();
                }
            } elseif ($request->tt > 0 && $request->sx == 0) {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->where('trang_thai', $request->tt)
                    ->orderby('ngay_dat', 'DESC')->get();
            } else {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->get();
            }
        }
        return view('admin.quanly.Donhang.locdh')->with('donhang', $dh);
    }
    
}
