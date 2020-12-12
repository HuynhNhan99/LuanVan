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
                        <p class="text-primary mb-0 hover-cursor">Dữ liệu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-6">
                            <h4 class="card-title">Danh sách các đánh giá</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control right my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <span class="input-group-text red lighten-3" id="basic-text1" style="color: white; background:#4d83ff;border-color: #4d83ff;"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                        <select class="form-control" id="sapxepdh" style="width:100%;">
                            <option value="0">--- Sắp xếp --- </option>
                            <option value="1">Theo giá</option>
                            <option value="2">Theo tên</option>
                            <option value="3">Theo ngày nhập</option>
                        </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>TÊN KHÁCH HÀNG</th>
                                    <th>TÊN SÁCH</th>
                                    <th>ĐIỂM</th>
                                    <th>NỘI DUNG</th>
                                    <th>TRẠNG THÁI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $danhgia as $key => $dg)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $dg->ten_kh }}</td>
                                    <td style="text-align: left;">{{ $dg->ten_sach }}</td>
                                    <td>{{ $dg->diem_dg }}</td>
                                    <td>{{ $dg->noi_dung }}</td>
                                    @if($dg->tt==0)
                                    <td><a href="ql-danhgia?tt={{$dg->tt}}&id_dg={{$dg->id_dg}}"><label class="badge badge-danger" style="cursor: pointer;">Ẩn</label></a></td>
                                    @else
                                    <td><a href="ql-danhgia?tt={{$dg->tt}}&id_dg={{$dg->id_dg}}"><label class="badge badge-primary" style="cursor: pointer;">Hiện</label></a></td>
                                    @endif
                                    <!-- <td><a href=""><i class="mdi mdi-arrow-down-bold" style="font-size: x-large;color: red;"></i></a></td> -->
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