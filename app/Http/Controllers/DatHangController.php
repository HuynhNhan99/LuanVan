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
use Toastr;

class DatHangController extends Controller
{
    public function CheckLoginKH()
    {
        $ad_id = Session::get('name');
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
            $data['email_kh'] = $request->email_kh;
            $data['matp'] = $request->matp;
            $data['maqh'] = $request->maqh;
            $data['maxa'] = $request->maxa;
            DB::table('khachhang')->where('id_kh', Session::get('id_kh'))->update($data);
            return Redirect::to('/dat-hang');
        }
    }
    public function Update_nxb(Request $request, $nxb_id)
    {
        $data = array();
        $data['ten_nxb'] = $request->ten_nxb;
        DB::table('nxb')->where('id_nxb', $nxb_id)->update($data);
        return Redirect::to('/list-nxb');
    }

    public function dat_hang()
    {
        $thanhtoan =  DB::table('thanhtoan')->get();
        $shipping =  DB::table('khachhang')->where('name', Session::get('name'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        $phi = DB::table('phivanchuyen')
            ->where('matp', $shipping->matp)
            ->where('maqh', $shipping->maqh)
            ->where('maxa', $shipping->maxa)->first();
        $thanhpho = ThanhPho::orderby('matp', 'ASC')->get();
        $khachhang =  DB::table('khachhang')->where('id_kh', Session::get('id_kh'))
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->first();
        //dd($khachhang);
       
        if ($phi) {
            Session::put('phiship', $phi->phi_vc);
        } else {
            Session::put('phiship', 30000);
        }
        return view('home.dathang.dathang')->with('shipping', $shipping)->with('thanhtoan', $thanhtoan)->with('khachhang', $khachhang)->with('thanhpho', $thanhpho);
    }
    public function thanhtoan(Request $request)
    {
        $tongtien = Cart::subtotal(0, '.', '');
        $tienship = Session::get('phiship');
        $data_dh = array();
        $data_dh['id_tt'] = $request->id_tt;
        $data_dh['id_kh'] = Session::get('id_kh');
        $data_dh['ngay_dat'] = now();
        $data_dh['tong_tien'] = $tongtien + $tienship;
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
        }
        Cart::destroy();
        return Redirect::to('/');
    }
    
    public function thanhtoan_vnpay(Request $request)
    {
        $url = session('url_prev','/');
    if($request->vnp_ResponseCode == "00") {
        $tongtien = Cart::subtotal(0, '.', '');
        $tienship = Session::get('phiship');
        $data_dh = array();
        $data_dh['id_tt'] = 2;
        $data_dh['id_kh'] = Session::get('id_kh');
        $data_dh['ngay_dat'] = now();
        $data_dh['tong_tien'] = $tongtien + $tienship;
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
    return redirect($url)->with('loi' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
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
        $ctdh = DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->where('donhang.id_dh', $id_dh)
            ->get();
        $dh =  DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->join('thanhtoan', 'thanhtoan.id_tt', '=', 'donhang.id_tt')
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'khachhang.matp')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'khachhang.maqh')
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maxa', '=', 'khachhang.maxa')
            ->where('donhang.id_dh', $id_dh)->first();
        $tt = DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->where('donhang.id_dh', $id_dh)
            ->selectRaw('sum(gia_sach) as tongtien')
            ->groupBy('donhang.id_dh')
            ->first();
        return view('admin.quanly.Donhang.ctdonhang')->with('tt', $tt)->with('ctdonhang', $ctdh)->with('khachhang', $dh);
    }
    public function in_dh($id_dh)
    {
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
                        <h2 style="font-size: 30px; font-family: DejaVu Sans;">Hóa đơn</h2><h3 class="pull-right">Order #' . $id_dh . '</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                            <strong>Thông tin đơn hàng:</strong><br>
                                Tên: John Smith<br>
                                Số điện thoại: 0123456789<br>
                                Địa chỉ: 1234 Main<br>
                                Email: <br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Phương thức thanh toán:</strong> Visa ending **** 4242<br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Ngày đặt:</strong> March 7, 2014<br><br>
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
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        <tr>
                                            <td>BS-200</td>
                                            <td class="text-center">$10.99</td>
                                            <td class="text-center">1</td>
                                            <td class="text-right">$10.99</td>
                                        </tr>
                                        <tr>
                                            <td>BS-400</td>
                                            <td class="text-center">$20.00</td>
                                            <td class="text-center">3</td>
                                            <td class="text-right">$60.00</td>
                                        </tr>
                                        <tr>
                                            <td>BS-1000</td>
                                            <td class="text-center">$600.00</td>
                                            <td class="text-center">1</td>
                                            <td class="text-right">$600.00</td>
                                        </tr>
                                        <tr>
                                            <td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                            <td class="thick-line text-right">$670.99</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>Shipping</strong></td>
                                            <td class="no-line text-right">$15</td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>Total</strong></td>
                                            <td class="no-line text-right">$685.99</td>
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
        if ($request->tt > 0 && $request->sx > 0) {
            if ($request->sx == 1) {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->where('trang_thai', $request->tt)
                    ->orderby('ngay_dat','DESC')->get();
            } elseif ($request->sx == 2) {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->where('trang_thai', $request->tt)
                    ->orderby('tong_tien','DESC')->get();
            } else {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->where('trang_thai', $request->tt)
                    ->orderby('trang_thai','DESC')->get();
            }
        } elseif($request->sx > 0 && $request->tt ==0) {
            if ($request->sx == 1) {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->orderby('ngay_dat','DESC')->get();
            } elseif ($request->sx == 2) {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->orderby('tong_tien','DESC')->get();
            } else {
                $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->orderby('trang_thai','ASC')->get();
            }
           
        }elseif($request->tt>0 && $request->sx ==0){
            $dh = DB::table('donhang')
                    ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                    ->where('trang_thai', $request->tt)
                    ->orderby('ngay_dat','DESC')->get();
        }else{
            $dh = DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->get();
        }
        return view('admin.quanly.Donhang.locdh')->with('donhang', $dh);
    }
    public function sapxep_dh($id_tt)
    {
        if ($id_tt) {
            $dh = DB::table('donhang')
                ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                ->where('trang_thai', $id_tt)->get();
        } else {
            $dh = DB::table('donhang')
                ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
                ->get();
        }
        return view('admin.quanly.Donhang.locdh')->with('donhang', $dh);
    }
}
