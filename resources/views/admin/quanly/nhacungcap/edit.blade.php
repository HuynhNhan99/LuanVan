@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CẬP NHẬT NHÀ CUNG CẤP</h4>
                    <form class="forms-sample" action="{{URL::to('addmin/update-ncc/'.$edit_ncc->id_ncc)}}" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="TrangThai">Tên Nhà cung cấp</label>
                                <input class="form-control" id="TenNcc" name="ten_ncc" value="{{ $edit_ncc->ten_ncc }}"></input>
                            </div>
                            <div class="form-group">
                                <label for="TrangThai">Số điện thoại</label>
                                <input class="form-control" id="SdtNxb" name="sdt_ncc" value="{{ $edit_ncc->sdt_ncc }}"></input>
                            </div>
                            <div class="form-group">
                                <label for="TrangThai">Email</label>
                                <input class="form-control" id="EmailNxb" name="email_ncc" value="{{ $edit_ncc->email_ncc }}"></input>
                            </div>
                            <div class="form-group">
                                <label for="TrangThai">Địa chỉ</label>
                                <input class="form-control" id="DchiNcc" name="diachi_ncc" value="{{ $edit_ncc->diachi_ncc }}"></input>
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
    </div>
</div>
@endsection