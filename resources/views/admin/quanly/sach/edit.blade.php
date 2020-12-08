@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CẬP NHẬT ĐẦU SÁCH</h4>
                    
                    <form class="forms-sample" action="{{URL::to('/save-sach')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @foreach ($edit_sach as $key => $sach)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="tenSach">Tên sách</label>
                                    <input type="text" class="form-control" id="TenSach" value="{{ $sach->ten_sach }}" name="ten_sach" required />
                                </div>
                                <div class="col-4">
                                    <label for="giaSach">Giá</label>
                                    <input type="text" class="form-control" id="giaSach" value="{{ $sach->gia_sach }}" name="gia_sach" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="MoTa">Mô tả</label>
                            <textarea class="form-control" id="MoTa" rows="6" name="mo_ta" >{{ $sach->mo_ta }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="SoTrang">Số trang</label>
                                    <input type="text" class="form-control" id="SoTrang" name="so_trang" value="{{ $sach->so_trang }}" required />
                                </div>
                                <div class="col-4">
                                    <label for="ChieuDai">Chiều dài</label>
                                    <input type="text" class="form-control" id="ChieuDai" name="chieu_dai" value="{{ $sach->chieu_dai }}" required />
                                </div>
                                <div class="col-4">
                                    <label for="ChieuRong">Chiều rộng</label>
                                    <input type="text" class="form-control" id="ChieuRong" name="chieu_rong" value="{{ $sach->chieu_rong }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="TrangThai">Trạng thái</label>
                                    <select class="form-control" id="TinhTrang" name="tinh_trang">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="NgonNgu">Ngôn ngữ</label>
                                    <select class="form-control" id="NgonNgu" name="ngon_ngu">
                                        <option value="1">Tiếng Việt</option>
                                        <option value="0">Tiếng Anh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="TheLoai">Thể loại</label>
                                    <select class="form-control" id="TheLoai" name="id_tl">
                                       
                                        <option value="{{ $sach->id_tl }}">{{ $sach->ten_tl }}</option>
                                       
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="TacGia">Tác giả</label>
                                    <select class="form-control" id="TacGia" name="id_tg">
                                        
                                        <option value="{{ $sach->id_tg }}">{{ $sach->ten_tg }}</option>
                                       
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="TacGia">Nhà xuất bản</label>
                                    <select class="form-control" id="NXB" name="id_nxb">
                                       
                                        <option value="{{ $sach->id_nxb }}">{{ $sach->ten_nxb }}</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" class="form-control" id="customFile" name="hinh_anh">
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection