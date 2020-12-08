<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng kí</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="admin/css/style.css">
    <!-- endinject -->
    <link rel="icon" type="image/png" href="theme/images/favicon.png">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-7 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="theme/images/logo.png" alt="logo">
                            </div>
                            <h4>ĐĂNG KÝ TÀI KHOẢN TẠI ĐÂY !</h4>
                            <form class="pt-3" action="{{URL::to('/dang-ki')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-9">
                                            <label for="tenSach">Tên khách hàng</label>
                                            <input type="text" class="form-control" name="ten_kh" required />
                                        </div>
                                        <div class="col-3">
                                            <label for="TrangThai">Giới tính</label>
                                            <select class="form-control" name="gioi_tinh">
                                                <option value="0">Nữ</option>
                                                <option value="1">Nam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="tenSach">Email</label>
                                            <input type="email" class="form-control" name="email_kh" required />
                                        </div>
                                        <div class="col-5">
                                            <label for="tenSach">Số điện thoại</label>
                                            <input type="text" class="form-control" name="sdt_kh" required />
                                            @if ($errors->has('sdt_kh'))
                                            <p style="color: red;">{{$errors->first('sdt_kh')}}</p>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Tinh/TP">Tỉnh/Thành phố:</label>
                                    <select class="form-control choose thanhpho" name="matp" id="thanhpho">
                                        <option>-----Tỉnh/Thành phố----</option>
                                        @foreach($thanhpho as $key =>$city)
                                        <option value="{{$city->matp}}">{{$city->tentp}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Tinh/TP">Quận huyện:</label>
                                    <select class="form-control choose quanhuyen" name="maqh" id="quanhuyen">
                                        <option>-----Quận huyện----</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Tinh/TP">Phường xã:</label>
                                    <select class="form-control xaphuong" name="maxa" id="xaphuong">
                                        <option>-----Phường xã----</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tenSach">Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi_kh" required />
                                </div>
                                <div class="form-group">
                                    <label for="tenSach">Tài khoản</label>
                                    <input type="text" class="form-control" name="name" required />
                                </div>
                                <div class="form-group">
                                    <label for="tenSach">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" required />
                                    @if ($errors->has('password'))
                                    <p style="color: red;">{{$errors->first('password')}}</p>
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium auth-form-btn" style="background:#f7941d">Submit</button>

                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Bạn đã có tài khoản? <a href="dangnhap-kh" class="text-primary">Đăng nhập tại đây</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 register-half-bg d-flex flex-row">
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="admin/js/off-canvas.js"></script>
    <script src="admin/js/hoverable-collapse.js"></script>
    <script src="admin/js/template.js"></script>
    <!-- endinject -->
    <script>
        $(".choose").change(function(){
        var action = $(this).attr('id');
        var maid = $(this).val();
        var result = '';
        if(action=='thanhpho'){
          result ='quanhuyen';
        }else{
          result = 'xaphuong';
        }
        $.ajax({
					url:"{{ url('select-dc') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"maid": maid,
						"action": action,
						}
				}).done(function(response){
					$("#"+result).html(response);
					
				})
      });
    </script>
</body>

</html>