@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">THÊM ĐẦU SÁCH</h4>
                    <form class="forms-sample" action="{{URL::to('addmin/save-sach')}}" method="post" enctype="multipart/form-data">
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
                                    <label for="NgonNgu">Ngôn ngữ</label>
                                    <select class="form-control" id="NgonNgu" name="ngon_ngu">
                                        <option value="1">Tiếng Việt</option>
                                        <option value="0">Tiếng Anh</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="NgonNgu">Số lượng sách</label>
                                    <input type="text" class="form-control" id="ChieuRong" name="sl_nhap" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="TacGia">Tác giả</label>
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Nhập tên tác giả" aria-label="Search">
                                <div class="input-group-append">
                                    <span class="input-group-text red lighten-3" id="basic-text1" style="color: white; background:#4d83ff;border-color: #4d83ff;"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="table-responsive" style="height: 150px;">
                                <table class="table table-hover" id="tlkm">
                                    <tbody>

                                        @foreach ($list_tacgia as $key => $tacgia)
                                        <tr>
                                            <td><input class="w3-check" type="checkbox" name="id_tg[]" value="{{$tacgia->id_tg}}" require></td>
                                            <td style="text-align: left;">{{$tacgia->ten_tg}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="TheLoai">Thể loại</label>
                                    <select class="form-control" id="TheLoai" name="id_tl">
                                        @foreach ($list_theloai as $key => $theloai)
                                        <option value="{{ $theloai->id_tl }}">{{ $theloai->ten_tl }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
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

                        <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection