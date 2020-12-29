<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/dashboard">
        <i class="fas fa-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="khach-hang">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Quản lý khách hàng</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi-book-multiple menu-icon"></i>
        <span class="menu-title">Quản lý Sách</span>
        <i class="fas fa-home menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-sach')}}">Quản lý sách</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-ncc')}}">Quản lý Nhà cung cấp</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-nxb')}}">Quản lý Nhà xuất bản</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-tacgia')}}">Quản lý Tác giả</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{URL::to('/list-theloai')}}">Quản lý Thế loại</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-cart menu-icon"></i>
        <span class="menu-title">Quản lý đơn hàng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/all-donhang">Tất cả đơn hàng</a></li>

        </ul>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#doanhthu" aria-expanded="false" aria-controls="doanhthu">
        <i class="mdi mdi-chart-areaspline menu-icon"></i>
        <span class="menu-title">Thống kê</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="doanhthu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="dt-thang">Doanh thu theo tháng</a></li>
          <li class="nav-item"> <a class="nav-link" href="dt-thang">Doanh thu theo năm</a></li>
          <li class="nav-item"> <a class="nav-link" href="top-10">Top cuốn sách bán chạy </a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="quanly-kho">
        <i class="mdi mdi-briefcase-check menu-icon"></i>
        <span class="menu-title">Quản lý Kho</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="list-danhgia">
        <i class="mdi mdi-briefcase-check menu-icon"></i>
        <span class="menu-title">Quản lý đánh giá</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="phi-vc">
        <i class="mdi mdi-truck menu-icon"></i>
        <span class="menu-title">Quản lý phí vận chuyển</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#km" aria-expanded="false" aria-controls="km">
        <i class="mdi mdi-shopping menu-icon"></i>
        <span class="menu-title">Quản lý khuyến mãi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="km">
        <ul class="nav flex-column sub-menu">
         
          <li class="nav-item"> <a class="nav-link" href="list-km">Danh sách khuyến mãi</a></li>

        </ul>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="pages/charts/chartjs.html">
        <i class="fas fa-sign-out-alt menu-icon"></i>
        <span class="menu-title">Đăng xuất</span>
      </a>
    </li>
  </ul>
</nav>