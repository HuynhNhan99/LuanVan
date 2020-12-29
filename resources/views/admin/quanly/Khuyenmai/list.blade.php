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
                        <p class="text-primary mb-0 hover-cursor">Quản lý các chương trình khuyến mãi</p>
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
                            <h4 class="card-title">Danh các chương trình khuyến mãi</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timkm1">
                                <div class="input-group-append">
                                    <button class="input-group-text red lighten-3" id="timkm" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <a href="khuyen-mai"><button type="button" class="btn right btn-primary" style="width:100%; height:100%">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tim-km">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên chương trình khuyến mãi</th>
                                    <th>Giảm giá</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Chi tiết </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $km as $key => $khuyenmai)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $khuyenmai->ten_km }}</td>
                                    <td>{{ $khuyenmai->phantram_km }}%</td>
                                    <td>{{ $khuyenmai->ngay_bat_dau }}</td>
                                    <td>{{ $khuyenmai->ngay_ket_thuc }}</td>
                                    <td><a href="{{URL::to('/chitiet-km/'.$khuyenmai->id_km)}}"><i class="fas fa-info-circle"></i></a></td>
                                   
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