@extends('index')
@section('noidung')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="/"><i class="fas fa-home"></i>Trang chủ</i></a></li>
                        <li class="active"><a href="blog-single.html" style="padding-left: 10px;">Đơn hàng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper" style="padding-top:20px;padding-bottom:60px;background: url(https://salt.tikicdn.com/desktop/img/bg-form.png) center bottom no-repeat;">
        <div class="content-wrapper" style=" background: white;margin-left: 300px;margin-right: 300px;padding: 20px; border-style: groove;">
            <div class="auth-form-transparent ">
                <h4>THÔNG TIN TÀI KHOẢN CỦA BẠN </h4>
                <hr />
                <form class="pt-3" action="{{URL::to('/dang-ki')}}" method="post">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Họ Tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  value="{{$kh->ten_kh}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Giới tính</label>
                        @if($kh->gioi_tinh==0)
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh"  value="0" checked style="width:16px;height:16px;">
                                <label class="form-check-label" for="inlineRadio1" style="padding-left: 20px;"> Nữ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh"  value="1" style="width:16px;height:16px;">
                                <label class="form-check-label" for="inlineRadio2" style="padding-left: 20px;"> Nam</label>
                            </div>
                        </div>
                        @else
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh"  value="0" style="width:16px;height:16px;">
                                <label class="form-check-label" for="inlineRadio1" style="padding-left: 20px;"> Nữ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gioi_tinh"  value="1" checked style="width:16px;height:16px;">
                                <label class="form-check-label" for="inlineRadio2" style="padding-left: 20px;"> Nam</label>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Địa chỉ</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext"  value="{{$kh->diachi_kh}}, {{$kh->tenxa}}, {{$kh->tenqh}}, {{$kh->tentp}}" style="width:80%;border: none;">
                            <a class="edit" data-toggle="modal" data-target="#Suadc" style="cursor: pointer;font-size: 14px;color: rgb(24, 158, 255);display: inline-block;padding: 6px 12px;">Chỉnh sửa</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Số điện thoại</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="sdt_kh" value="{{$kh->sdt_kh}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email_kh" value="{{$kh->email_kh}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="check_mk" onchange="checkboxes()" style="width:16px;height:16px;">
                                <label class="form-check-label" style="padding-left:20px;">Thay đổi mật khẩu</label>
                            </div>
                        </div>
                    </div>
                    <div class="thaydoi_mk" style="display: none;">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mật khẩu hiện tại</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Mật khẩu mới</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu mới">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nhập lại</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                        </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<div class="modal fade" id="Suadc" tabindex="-1" role="dialog" aria-labelledby="Suadc" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Suadc" style="font-size: 18px;">THAY ĐỔI ĐỊA CHỈ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top: 20px;padding-right: 20px;">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form class="form" method="post" action="{{URL::to('dat-hang')}}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Tinh/TP">Tỉnh/Thành phố:</label>
                        <select class="form-control choose thanhpho" name="matp" id="thanhpho" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;">
                            <option>-----Tỉnh/Thành phố----</option>
                            @foreach($thanhpho as $key =>$city)
                            <option value="{{$city->matp}}">{{$city->tentp}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('matp'))
                        <p style="color: red;">{{$errors->first('matp')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Tinh/TP">Quận huyện:</label>
                        <select class="form-control choose quanhuyen" name="maqh" id="quanhuyen" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;">
                            <option>-----Quận huyện----</option>
                        </select>
                        @if ($errors->has('maqh'))
                        <p style="color: red;">{{$errors->first('maqh')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Tinh/TP">Phường xã:</label>
                        <select class=" form-control xaphuong" name="maxa" id="xaphuong" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;">
                            <option>-----Phường xã----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ<span> *</span></label>
                        <input type="text" class="form-control" name="diachi_kh" placeholder="" required="required" value="" style="font-family: inherit;font-size: 15px;font-weight: normal; height:45px;" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class=" btn button" type="submit">XÁC NHẬN</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection