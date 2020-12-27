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
                        <li class="active"><a href="dat-hang" style="padding-left: 10px;">Xác nhận địa chỉ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
<div style="background: rgb(239, 239, 239); height:400px;">
    <div class="container">
        <div style="margin-top: 30px;margin-bottom: 20px;">
            <h3>XÁC NHẬN ĐỊA CHỈ</h3>
            <p>Vui lòng kiểm tra thông tin trước khi đặt hàng!</p>
        </div>
        @if(isset($khachhang))
        <div class="thongtin" style="background: white;">
            <div class="row diachi" style="margin: 0px;border-radius: 0px;">
                <div class="col-10 info">
                    <div class="ten" style="text-transform: uppercase;margin: 0px 0px 10px;">
                        <span class="fas fa-map-marker-alt" style="font-size: 14px;display: inline-block;-webkit-box-align: center;align-items: center;color: rgb(38, 188, 78);text-transform: none;"> Địa chỉ nhận hàng</span>
                    </div>
                    <div class="sdt">
                        <span style="color:rgb(120, 120, 120)">Họ và tên:</span> {{$khachhang->ten_kh}}
                    </div>
                    <div class="sdt">
                        <span style="color:rgb(120, 120, 120)">Số điện thoại:</span> {{$khachhang->sdt_kh}}
                    </div>
                    <div class="diachi">
                        <span style="color:rgb(120, 120, 120)">Địa chỉ:</span> {{$khachhang->diachi_kh}}, {{$khachhang->tenxa}}, {{$khachhang->tenqh}}, {{$khachhang->tentp}}
                    </div>
                </div>
                <div class="col-2 action" style="text-align: end;">
                    <a class="edit" data-toggle="modal" data-target="#Themnxb" style="cursor: pointer;font-size: 14px;color: #f7941d ;display: inline-block;padding: 6px 12px;">Chỉnh sửa</a>
                </div>
                <div style="padding-left: 15px;padding-top: 15px;">
                    <a href="dat-hang"><button type="button" class="btn btn-light" style="padding-top: 10px;padding-bottom: 10px;padding-right: 20px;padding-left: 20px;"> Giao đến địa chỉ này
                    </button></a>
                </div>
            </div>

        </div>
        @else
        <div class="thongtin" style="background: white;">
            <div class="row diachi" style="margin: 0px;border-radius: 0px;">
            <p>Vui lòng thêm địa chỉ và số điện thoại để đặt hàng!<a class="edit" data-toggle="modal" data-target="#Themnxb" style="cursor: pointer;font-size: 14px;color: #f7941d ;"> Thêm địa chỉ</a></p>
            </div>

        </div>
        @endif
    </div>
</div>

<div class="modal fade" id="Themnxb" tabindex="-1" role="dialog" aria-labelledby="Themnxb" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Themnxb" style="font-size: 18px;">THAY ĐỔI THÔNG TIN GIAO HÀNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top: 20px;padding-right: 20px;">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form class="form" method="post" action="{{URL::to('dat-hang')}}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @if(isset($khachhang))
                    <div class="form-group">
                        <label>Số điện thoại<span> *</span></label>
                        <input type="text" class="form-control" name="sdt_kh" placeholder="" required="required" value="{{$khachhang->sdt_kh}}" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;" require>
                    </div>
                    @else
                    <div class="form-group">
                        <label>Số điện thoại<span> *</span></label>
                        <input type="text" class="form-control" name="sdt_kh" placeholder="" required="required" value="" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;" require>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="Tinh/TP">Tỉnh/Thành phố:</label>
                        <select class="form-control choose thanhpho" name="matp" id="thanhpho" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;">
                            <option>-----Tỉnh/Thành phố----</option>
                            @foreach($thanhpho as $key =>$city)
                            <option value="{{$city->matp}}">{{$city->tentp}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('matp'))
                        <p style="color: red;">{{$errors->first('matp')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Tinh/TP">Quận huyện:</label>
                        <select class="form-control choose quanhuyen" name="maqh" id="quanhuyen" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;">
                            <option>-----Quận huyện----</option>
                        </select>
                        @if ($errors->has('maqh'))
                        <p style="color: red;">{{$errors->first('maqh')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Tinh/TP">Phường xã:</label>
                        <select class=" form-control xaphuong" name="maxa" id="xaphuong" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;">
                            <option>-----Phường xã----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ<span> *</span></label>
                        <input type="text" class="form-control" name="diachi_kh" placeholder="" required="required" value="" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class=" btn button" type="submit">XÁC NHẬN</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection