@extends('admin.index')
@section('noidung')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Chi tiết đơn hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">THÔNG TIN ĐƠN HÀNG</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row" style="text-align: right; padding-left: 0px;width: 550px; padding:10px;">Người nhận</th>
                                    <td  style="text-align: left;">{{ $khachhang->ten_kh }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="text-align: right;padding-left: 0px;width: 550px;padding:10px;">Số điện thoại</th>
                                    <td style="text-align: left;">{{ $khachhang->sdt_kh }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="text-align: right;padding-left: 0px;width: 550px;padding:10px;">Địa chỉ</th>
                                    <td style="text-align: left;">{{ $khachhang->dc_dh }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="text-align: right;padding-left: 0px;width: 550px;padding:10px;">Hình thức thanh toán</th>
                                    <td style="text-align: left;">{{ $khachhang->ten_tt }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="text-align: right;padding-left: 0px;width: 550px;padding:10px;">Ngày đặt</th>
                                    <td style="text-align: left;">{{ $khachhang->ngay_dat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-6">
                            <h4 class="card-title">DANH SÁCH CÁC ĐƠN HÀNG</h4>
                        </div>
                        <div class="col-lg-6">
                            <button type="button" class="btn right btn-primary "><a target="blank" href="{{URL::to('/in-dh/'.$khachhang->id_dh)}}" style="color: #f4f7fa;">IN HÓA ĐƠN</a></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>HÌNH ẢNH</th>
                                    <th>TÊN SÁCH</th>
                                    <th>GIÁ SÁCH</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>THÀNH TIỀN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $ctdonhang as $key => $sach)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="<?php
                                                    if (file_exists('public/uploads/anhsach/' . $sach['hinh_anh'])) {
                                                        echo 'public/uploads/anhsach/' . $sach['hinh_anh'];
                                                    } else {
                                                        echo $sach['hinh_anh'];
                                                    }
                                                    ?>" style="width:50px;"></td>
                                    <td>{{ $sach['ten_sach'] }} </td>
                                    <td>{{ number_format($sach['gia_sach'] -($sach['gia_sach']* $sach['phantram_km']/100)) }}</td>
                                    <td>{{ $sach['so_luong'] }}</td>
                                    <td>{{ number_format($sach['so_luong'] *($sach['gia_sach'] -($sach['gia_sach']* $sach['phantram_km']/100))) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                <td>Thành tiền: {{ $khachhang->tong_tien }}</td>
                                </tr>
                                <tr>   
                                <td>Phí ship: {{ $khachhang->tien_ship }}</td>
                                </tr>
                                <tr>
                                <td>Tổng tiền: {{ $khachhang->tong_tien + $khachhang->tien_ship }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection