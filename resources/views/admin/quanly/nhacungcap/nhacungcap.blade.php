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
                        <p class="text-primary mb-0 hover-cursor">Quan lý nhà cung cấp</p>
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
                            <h4 class="card-title">Danh sách nhà cung cấp</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timncc1">
                                <div class="input-group-append">
                                    <button class="input-group-text red lighten-3" id="timncc" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn right btn-primary" data-toggle="modal" data-target="#Themncc" style="width:100%; height:100%">Thêm mới</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tim-ncc">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $list_ncc as $key => $ncc)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $ncc->ten_ncc }}</td>
                                    <td>{{ $ncc->sdt_ncc }}</td>
                                    <td>{{ $ncc->email_ncc }}</td>
                                    <td>{{ $ncc->diachi_ncc }}</td>
                                    <td>
                                        <a href="{{URL::to('addmin/edit-ncc/'.$ncc->id_ncc)}}"><i class="fa fa-edit"></i></a>
                                        <a href="{{URL::to('addmin/delete-ncc/'.$ncc->id_ncc)}}"><i class="fas fa-trash "></i></a>
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
<div class="modal fade" id="Themncc" tabindex="-1" role="dialog" aria-labelledby="Themncc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Themncc">Thêm Nhà xuất bản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{URL::to('addmin/add-ncc')}}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="TrangThai">Tên Nhà cung cấp</label>
                        <input class="form-control" id="TenNcc" name="ten_ncc"></input>
                    </div>
                    <div class="form-group">
                        <label for="TrangThai">Số điện thoại</label>
                        <input class="form-control" id="SdtNxb" name="sdt_ncc"></input>
                    </div>
                    <div class="form-group">
                        <label for="TrangThai">Email</label>
                        <input class="form-control" id="EmailNxb" name="email_ncc"></input>
                    </div>
                    <div class="form-group">
                        <label for="TrangThai">Địa chỉ</label>
                        <input class="form-control" id="DchiNcc" name="diachi_ncc"></input>
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