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
                            <h4 class="card-title">Danh sách nhà xuất bản</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <span class="input-group-text red lighten-3" id="basic-text1" style="color: white; background:#4d83ff;border-color: #4d83ff;"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn right btn-primary" data-toggle="modal" data-target="#Themnxb" style="width:100%; height:100%">Thêm mới</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên nhà xuất bản</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $list_nxb as $key => $nxb)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $nxb->ten_nxb }}</td>
                                    <td>
                                        <a href="{{URL::to('/edit-nxb/'.$nxb->id_nxb)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{URL::to('/delete-nxb/'.$nxb->id_nxb)}}">
                                            <i class="fas fa-trash "></i>
                                        </a>
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
                <h5 class="modal-title" id="Themnxb">Thêm Nhà xuất bản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{URL::to('/add-nxb')}}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="TrangThai">Tên Nhà xuất bản</label>
                        <input class="form-control" id="TenNxb" name="ten_nxb"></input>
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