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
                        <a href="quanly-kho"><p class="text-primary mb-0 hover-cursor">Quản lý kho sách</p></a>
                        <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;Chi tiết kho sách</p>
                        <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;{{$tensach->ten_sach}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CHI TIẾT KHO HÀNG</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Lần nhập</th>
                                    <th>Ngày nhập</th>
                                    <th>Số lượng nhập </th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach( $ct_kho as $key => $sach)
                                <tr>
                                    <td>Lần nhập thứ {{$key+1}}</td>
                                    <td>{{$sach->ngay_nhap_hang}}</td>
                                    <td>{{$sach->sl_nhap}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection