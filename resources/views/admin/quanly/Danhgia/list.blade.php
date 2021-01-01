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
                        <p class="text-primary mb-0 hover-cursor">Quản lý đánh giá</p>
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
                        <div class="col-lg-5">
                        <h4 class="card-title">Danh sách các đánh giá</h4>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timdg1">
                                <div class="input-group-append">
                                    <button class="input-group-text red lighten-3" id="timdg" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <select class="form-control" id="sapxepdg" style="width:100%;">
                                <option value="2">--- Trạng thái --- </option>
                                <option value="0">Ẩn đánh giá</option>
                                <option value="1">Hiện đánh giá</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tim-dg">
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
                                    <td><a href="addmin/ql-danhgia?tt={{$dg->tt}}&id_dg={{$dg->id_dg}}"><label class="badge badge-danger" style="cursor: pointer;">Ẩn</label></a></td>
                                    @else
                                    <td><a href="addmin/ql-danhgia?tt={{$dg->tt}}&id_dg={{$dg->id_dg}}"><label class="badge badge-primary" style="cursor: pointer;">Hiện</label></a></td>
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