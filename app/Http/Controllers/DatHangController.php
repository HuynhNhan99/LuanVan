<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\ThanhPho;

use Barryvdh\DomPDF\Facade as PDF;


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
        return Redirect::to('addmin/list-nxb');
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
            $data_ctdh['gia'] = $ctgiohang->price;
            DB::table('ctgiohang')->insert($data_ctdh);
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
            dd($giohang);
            $id_dh = DB::table('donhang')->insertGetId($data_dh);
            foreach ($giohang as $ctgiohang) {
                $data_ctdh['id_dh'] = $id_dh;
                $data_ctdh['id_sach'] = $ctgiohang->id;
                $data_ctdh['so_luong'] = $ctgiohang->qty;
                $data_ctdh['gia'] = $ctgiohang->price;
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
        $ctdh = DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->where('donhang.id_dh', $id_dh)
            ->get();

        $dh =  DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->join('thanhtoan', 'thanhtoan.id_tt', '=', 'donhang.id_tt')
            ->where('donhang.id_dh', $id_dh)->first();
        return view('admin.quanly.Donhang.ctdonhang')->with('ctdonhang', $ctdh)->with('khachhang', $dh);
    }
    public function in_dh($id_dh)
    {
        //sử dụng mảng
        $ctdh = DB::table('donhang')
            ->join('ctgiohang', 'ctgiohang.id_dh', '=', 'donhang.id_dh')
            ->join('dausach', 'dausach.id_sach', '=', 'ctgiohang.id_sach')
            ->where('donhang.id_dh', $id_dh)
            ->get();
        $kh =  DB::table('donhang')
            ->join('khachhang', 'donhang.id_kh', '=', 'khachhang.id_kh')
            ->join('thanhtoan', 'thanhtoan.id_tt', '=', 'donhang.id_tt')
            ->where('donhang.id_dh', $id_dh)->first();
        $pdf = \App::make('dompdf.wrapper');
        $output='';

        $output.='<style>
                    body{
                        font-family: DejaVu Sans;
                    }
                  </style>

                <h3>Cửa hàng ABC</h3>
                <p>Địa chỉ: Số xx, đường abc, phường def, quận Ninh Kiều, TPCT<br>Email: abc@gmail.com<br> SĐT: 0101010101</p>
                <h2 align="center">HÓA ĐƠN BÁN HÀNG</h2>
                <br>
                <br>
                <center><table width="100%">
                    <thead>';
                    $output.='<tr>';
                    $output.='<th width="25%" align="left">Tên khách hàng: </th><td>'.$kh->ten_kh.'</td>
                              <th width="3%"></th> 
                              <th width="20%" align="left">Số điện thoại: </th><td>'.$kh->sdt_kh.'</td>';           
                    $output.='</tr>';
                    $output.='<tr>';
                    $output.='<th align="left">Địa chỉ: </th><td colspan="4">'.$kh->dc_dh.'</td>';           
                    $output.='</tr>';
                        
                $output.='</thead>
                </table></center><br><br>';

        $output.='<table class="sanpham" width="100%" style="border:1px solid">
                    <thead>';   
                    $output.='<tr align="center">
                              <th>STT</th> 
                              <th>Tên sản phẩm</th>
                              <th>Giá</th>
                              <th>Số lượng</th>
                              <th>Thành tiền</th>           
                              </tr>
                    </thead>';

          $output.='<tbody>';
                        foreach($ctdh as $k => $sp){
                          
                    $output.='<tr align="center">';
                    $output.='<td>1</td>
                              <td>'.$sp->ten_sach.'</td>
                              <td>'.$sp->gia_sach.'</td>
                              <td>'.$sp->so_luong.'</td></tr>';
                        }

          $output.='</tbody>
                </table>';

        $output.='<table align="right">';
        $output.='<tr>
        <th align="left">Tổng đơn hàng: </th><td>'.number_format(10000).''.'VNĐ'.'</td>
                  </tr>
                  <tr>
                    <th align="left">Phí vận chuyển: </th><td>1000</td>
                  </tr>
                  <tr>
                    <th align="left">Tổng tiền: </th><td>'.number_format(100000).''.'VNĐ'.'</td>
                  </tr>';
                  
                
        $output.=' </table><br><br><br><br>';

        $output.='<br><br><table width="100%">

                    <th align="center">Người mua</th>
                    <th align="center">Người bán</th>

                 </table>';

        $pdf->loadHTML($output);
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
