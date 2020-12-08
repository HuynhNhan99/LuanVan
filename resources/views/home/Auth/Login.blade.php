<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Đăng nhập</title>
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
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="theme/images/logo.png" alt="logo">
              </div>
              <?php
                use Illuminate\Support\Facades\Session;
                $name = Session::get('message');
                $thanhcong = Session::get('thanhcong');
              ?>
              @if($thanhcong)
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                 {{$thanhcong}}
              </div>
              @elseif($name)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                 {{$name}}
              </div>
              @endif
              <h4>ĐĂNG NHẬP</h4>
              <h6 class="font-weight-light"></h6>
              <form class="pt-3" action="{{URL::to('/dangnhap-kh')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="exampleInputEmail">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-warning"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" name="name" placeholder="Username"  required>
                  </div>
                </div>
                @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                {{$errors->first('name')}}
                </div>
                @endif
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-warning"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" name="password" placeholder="Password"  required>
                  </div>
                </div>
                @if ($errors->has('password'))
                <div class="alert alert-danger" role="alert">
                {{$errors->first('password')}}
                </div>
                @endif
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    <i class="input-helper"></i></label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <div class=" mt-4 font-weight-light">
                Quên mật khẩu? Nhấn vào <a class="text-primary" data-toggle="modal" data-target="#Themnxb" style="cursor: pointer;">đây</a>
                </div>
                <div class="my-3">
                  <button type="submit" class="btn btn-block btn-lg font-weight-medium auth-form-btn" style="background: #f7941d">Submit</button>
                </div>
                
                <div class="mb-2 d-flex">
                  <button type="button" class="btn btn-facebook auth-form-btn flex-grow mr-1">
                    <i class="mdi mdi-facebook mr-2"></i>Facebook
                  </button>
                  <button type="button" class="btn btn-google auth-form-btn flex-grow ml-1">
                    <i class="mdi mdi-google mr-2"></i>Google
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Bạn đã có tài khoản chưa? <a href="dangki-kh" class="text-primary">Đăng kí tại đây</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">

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
  <!-- Thêm -->
<div class="modal fade" id="Themnxb" tabindex="-1" role="dialog" aria-labelledby="Themnxb" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Themnxb">ĐẶT LẠI MẬT KHẨU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{URL::to('/reset-mk')}}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Phi">Vui lòng nhập email để đặt lại mật khẩu !</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>


        </div>
    </div>
</div>
</body>

</html>