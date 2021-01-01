@extends('admin.index')
@section('noidung')
<?php
if (isset($slban->soluong)) {
    $sl = $slban->soluong;
} else {
    $sl = 0;
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <a href="addmin/quanly-kho">
                            <p class="text-primary mb-0 hover-cursor">Quản lý kho sách</p>
                        </a>
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
                    <div class="row">
                        <div class="col-2">
                            <img src="<?php
                                        if (file_exists('public/uploads/anhsach/' . $tensach->hinh_anh)) {
                                            echo 'public/uploads/anhsach/' . $tensach->hinh_anh;
                                        } else {
                                            echo $tensach->hinh_anh;
                                        }
                                        ?>" atl="" style="width: 150px; height: 150px; border-radius: 0%;" />
                        </div>
                        <div class="col-6">
                            <h4>{{$tensach->ten_sach}}</h4>
                            <p>Số lượng bán: {{$sl}}</p>
                            <p>Tổng số lượng nhập: {{$slnhap->soluong}}</p>
                            <p>Tổng số lượng tồn: {{$slnhap->soluong - $sl}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 10px;">
                            <button type="button" class="btn right btn-primary" data-toggle="modal" data-target="#Themncc">Nhập kho</button>
                        </div>
                    </div>
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

<div class="modal fade" id="Themncc" tabindex="-1" role="dialog" aria-labelledby="Themncc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Themncc">Thêm số lượng sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{URL::to('addmin/them-kho')}}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="TrangThai">Số lượng</label>
                        <input class="form-control" id="sl_nhap" name="sl_nhap"></input>
                        <input class="form-control" type="hidden" id="id_sach" name="id_sach" value="{{$tensach->id_sach}}"></input>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection