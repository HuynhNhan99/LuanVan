@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">THÊM ĐẦU SÁCH</h4>
                    <form class="forms-sample" action="{{URL::to('/save-sach')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="tenSach">Tên sách</label>
                                    <input type="text" class="form-control" id="TenSach" name="ten_sach" required />
                                </div>
                                <div class="col-4">
                                    <label for="giaSach">Giá</label>
                                    <input type="text" class="form-control" id="giaSach" name="gia_sach" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="MoTa">Mô tả</label>
                            <textarea class="form-control" id="MoTa" rows="6" name="mo_ta"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="SoTrang">Số trang</label>
                                    <input type="text" class="form-control" id="SoTrang" name="so_trang" required />
                                </div>
                                <div class="col-4">
                                    <label for="ChieuDai">Chiều dài</label>
                                    <input type="text" class="form-control" id="ChieuDai" name="chieu_dai" required />
                                </div>
                                <div class="col-4">
                                    <label for="ChieuRong">Chiều rộng</label>
                                    <input type="text" class="form-control" id="ChieuRong" name="chieu_rong" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="TrangThai">Trạng thái</label>
                                    <select class="form-control" id="TrangThai" name="trang_thai">
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
                                        @foreach ($list_theloai as $key => $theloai)
                                        <option value="{{ $theloai->id_tl }}">{{ $theloai->ten_tl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="TacGia">Tác giả</label>
                                    <select class="form-control" id="TacGia" name="id_tg">
                                        @foreach ($list_tacgia as $key => $tacgia)
                                        <option value="{{ $tacgia->id_tg }}">{{ $tacgia->ten_tg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="TacGia">Nhà xuất bản</label>
                                    <select class="form-control" id="NXB" name="id_nxb">
                                        @foreach ($list_nxb as $key => $nxb)
                                        <option value="{{ $nxb->id_nxb }}">{{ $nxb->ten_nxb }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="TheLoai">Nhà cung cấp</label>
                            <select class="form-control" id="NCC" name="id_ncc">
                                @foreach ($list_ncc as $key => $ncc)
                                <option value="{{ $ncc->id_ncc }}">{{ $ncc->ten_ncc }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Thêm hình</label>
                            <input type="file" class="form-control" id="customFile" name="hinh_anh">
                        </div>
                        <div class="form-group">
                            <label>Thêm nhiều hình</label>
                            @for($i=1; $i<=4;$i++) <input type="file" class="form-control" name="fhinh_anh[]">
                                @endfor
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection