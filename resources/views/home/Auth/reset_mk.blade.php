@extends('index')
@section('noidung')
<div class="container" style="background: url(https://salt.tikicdn.com/desktop/img/bg-form.png) center bottom no-repeat;">
    <div style="height: 300px; width:500px;margin-left:300px;margin-top:30px;">
    <div style="    border-style: groove;">
        <div class="modal-header">
            <h3>TẠO MẬT KHẨU MỚI</h3>
        </div>
        <?php
                    $token=$_GET['token'];
                    $email=$_GET['email'];
                    ?>
        @if($kh)
        <form class="forms-sample" action="{{URL::to('/datlai-mk')}}" method="post">
            <div class="modal-body">
            {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" name="token" value="{{$token}}"/>
                    <input type="hidden" name="email" value="{{$email}}"/>
                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới" required />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="re_password" placeholder="Xác nhận lại mật khẩu" required />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="width:100%">Thêm</button>
                </div>
            </div>
        </form>
        @else
        <p style="margin:50px;"> Link thay đổi mật khẩu không đúng hoặc đã hết hiệu lực!</p>
        @endif
    </div>
    </div>
</div>


@endsection