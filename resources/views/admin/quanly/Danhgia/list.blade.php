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
                        <div class="col-lg-8">
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
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tên sách</th>
                                    <th>Điểm đánh giá</th>
                                    <th>Nội dung đánh giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $danhgia as $key => $dg)
                                {{ csrf_field() }}
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $dg->ten_kh }}</td>
                                    <td style="text-align: left;">{{ $dg->ten_sach }}</td>
                                    <td>{{ $dg->diem_dg }}</td>
                                    <td>{{ $dg->noi_dung }}</td>
                                    <td><a href=""><i class="mdi mdi-arrow-up-bold" style="font-size: x-large;color: green;"></i></a></td>
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