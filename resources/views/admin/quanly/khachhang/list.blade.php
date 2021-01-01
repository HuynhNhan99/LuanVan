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
                        <p class="text-primary mb-0 hover-cursor">Quản lý khách hàng</p>
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
                            <h4 class="card-title">Danh sách khách hàng</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timkh1">
                                <div class="input-group-append">
                                    <button class="input-group-text red lighten-3" id="timkh" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tim-kh">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>email</th>
                                    <th>username</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $khachhang as $key => $kh)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $kh->ten_kh }}</td>
                                    <td><?php if ($kh->gioi_tinh == 0) echo 'nữ';
                                        else echo 'nam';
                                        ?></td>
                                    <td>{{ $kh->sdt_kh }}</td>
                                    <td>{{ $kh->email_kh }}</td>
                                    <td>{{ $kh->name }}</td>
                                    <td>
                                        <a href="{{URL::to('addmin/delete-khachhang/'.$kh->id_kh)}}"><i class="fas fa-trash "></i></a>
                                    </td>
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

<!-- Thêm -->
<div class="modal fade" id="Themnxb" tabindex="-1" role="dialog" aria-labelledby="Themnxb" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Themnxb">THÊM PHÍ VẬN CHUYỂN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>
    </div>
</div>
@endsection