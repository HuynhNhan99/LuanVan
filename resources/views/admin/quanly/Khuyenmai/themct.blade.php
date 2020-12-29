@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">THÊM CHƯƠNG TRÌNH KHUYẾN MÃI</h4>
                    <form class="forms-sample" action="{{URL::to('/add-km')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="TheLoai">Chọn thể loại</label>
                                    <select class="form-control theloaikm" id="theloaikm" name="id_tl">
                                        <option>--Chọn thể loại--</option>
                                        @foreach ($tl as $key => $theloai)
                                        <option value="{{ $theloai->id_tl }}">{{ $theloai->ten_tl }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="giaSach">Tìm kiếm theo tên</label>
                                    <div class="input-group md-form form-sm form-2 pl-0">
                                        <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timkiem">
                                        <div class="input-group-append">
                                            <a class="input-group-text red lighten-3" id="search1" style="color: white; background:#4d83ff;border-color: #4d83ff; cursor:pointer;" ><i class="fas fa-search text-grey" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="table-responsive" style="height: 300px;">
                                <table class="table table-hover" id="tlkm">
                                    <thead>
                                        <tr>
                                            <th style="width:80px; font-size: 14px;">CHỌN</th>
                                            <th style="font-size: 14px;">TÊN SÁCH</th>
                                            <th style=" font-size: 14px;">TÊN THỂ LOẠI</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach( $list_theloai as $key => $tl)
                                        <tr>
                                            <td><input class="w3-check" type="checkbox" name="id_sach[]" value="{{$tl->id_sach}}"></td>
                                            <td style="text-align: left;">{{$tl->ten_sach}}</td>
                                            <td>{{$tl->ten_tl}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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