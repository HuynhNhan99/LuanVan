@extends('index')
@section('noidung')
<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

$sachs = Cart::content();
$tongtien = Cart::subtotal(0, '.', '');
$count = Cart::count();
$phiship = Session::get('phiship');
?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="/"><i class="fas fa-home"></i>Trang chủ </a></li>
                        <li class="active"><a href="dat-hang" style="padding-left: 10px;">Đặt hàng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<div class="container">
    <div class="thongtin">

        <div class="row diachi" style="margin: 0px;">
            <div class="col-10 info">
                <div class="ten" style="text-transform: uppercase;margin: 0px 0px 10px;">
                    {{$khachhang->ten_kh}}
                    <span class="fas fa-map-marker-alt" style="font-size: 14px;margin: 0px 0px 0px 15px;display: inline-block;-webkit-box-align: center;align-items: center;color: rgb(38, 188, 78);text-transform: none;"> Địa chỉ nhận hàng</span>
                </div>
                <div class="sdt">
                    <span style="color:rgb(120, 120, 120)">Số điện thoại:</span> {{$khachhang->sdt_kh}}
                </div>
                <div class="diachi">
                    <span style="color:rgb(120, 120, 120)">Địa chỉ:</span> {{$khachhang->diachi_kh}}, {{$khachhang->tenxa}}, {{$khachhang->tenqh}}, {{$khachhang->tentp}}
                </div>
            </div>
            <div class="col-2 action" style="text-align: end;">
                <a class="edit" href="xacnhan-dc" style="cursor: pointer;font-size: 14px;color: #f7941d ;display: inline-block;padding: 6px 12px;">Chỉnh sửa</a>
            </div>
        </div>

    </div>

    <div class=" shop checkout section">
        <div class="row" style="margin: 0px;">
            <div class="col-lg-8 col-12" style="padding: 0px; text-align: center; margin-top:30px;border-radius: 5px; border: 1px solid #ccc;">
                <div class="row" style="padding:10px;margin-left: 0px;">Đơn hàng ({{$count}} sản phẩm)</div>
                <div class="row" style="margin:0px 0px 0px 0px;line-height: 40px;background: antiquewhite; ">
                    <div class="col-1" style="padding-right: 0px;">

                    </div>
                    <div class="col-4" style="padding: 0px;">SẢN PHẨM</div>
                    <div class="col-3">GIÁ</div>
                    <div class="col-2">SỐ LƯỢNG</div>
                    <div class="col-2">TỔNG TIỀN</div>
                </div>
                @foreach ($sachs as $key => $sach)
                <div class="row" style="margin:0px 0px 10px 0px ; padding:10px;border-bottom: 1px solid #ccc;">
                    <div class="col-1" style="padding-right: 5px;padding-left: 5px;">
                        <img src="<?php
                                    if (file_exists('public/uploads/anhsach/' . $sach->options->image)) {
                                        echo 'public/uploads/anhsach/' . $sach->options->image;
                                    } else {
                                        echo $sach->options->image;
                                    }
                                    ?>" style="width:50px;">
                    </div>
                    <div class="col-4" style="padding: 0px; text-align: left;">{{ $sach->name }}</div>
                    <div class="col-3">{{ number_format($sach->price) }} đ</div>
                    <div class="col-2">{{ $sach->qty }}</div>
                    <div class="col-2">{{ number_format($sach->qty * $sach->price) }} đ</div>
                </div>
                @endforeach
            </div>
            <div class="col-lg-4 col-12" style="padding-right: 0px;">
                <div class="order-details">
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>Tổng thanh toán</h2>
                        <div class="content">
                            <ul>
                                <li>Tạm tính<span>{{number_format($tongtien)}} đ</span></li>
                                <li>Phí ship<span>{{number_format($phiship)}} đ</span></li>
                                <li class="last">Thành tiền<span style="font-size: 25px; color:#f7941d ;">{{number_format($tongtien+$phiship)}} đ</span></li>
                            </ul>
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Order Widget -->

                    <form method="post" action="{{URL::to('thanh-toan')}}">
                        {{ csrf_field() }}
                        <div class="single-widget">

                            <h2>Chọn hình thức thanh toán</h2>
                            @foreach ($thanhtoan as $key => $pay)
                            <div class="form-check" style=" padding-left: 30px;">
                                <input class="form-check-input" type="radio" name="id_tt" value="{{$pay->id_tt}}" require>
                                <label class="form-check-label" for="exampleRadios1">
                                    {{ $pay->ten_tt }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <!--/ End Order Widget -->
                        <!-- Payment Method Widget -->
                        <div class="single-widget payement">
                            <div class="content">
                                <img src="theme/images/payment-method.png" alt="#">
                            </div>
                        </div>
                        <!--/ End Payment Method Widget -->
                        <!-- Button Widget -->
                        <div class="single-widget get-button">
                            <div class="content">
                                <button class=" btn button" type="submit">THANH TOÁN</button>
                            </div>
                        </div>
                    </form>
                    <!--/ End Button Widget -->
                </div>
            </div>
        </div>

    </div>
</div>

@endsection