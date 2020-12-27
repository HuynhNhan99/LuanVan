<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

$id_kh = Session::get('id_kh');
$sachs = Cart::content();
$tongtien = Cart::subtotal();
$tong = Cart::total();
$count = Cart::count();
?>
<header class="header shop">
	<!-- Topbar -->
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12 col-12">
					<!-- Top Left -->
					<div class="top-left">
						<ul class="list-main">
							<li><i class="ti-headphone-alt"></i> +(84) 385 3699 55</li>
							<li><i class="ti-email"></i> httnhan99@gmail.com</li>
						</ul>
					</div>
					<!--/ End Top Left -->
				</div>
				<div class="col-lg-8 col-md-12 col-12">
					<!-- Top Right -->
					<div class="right-content">
						<ul class="list-main">
							@if($id_kh)
							<li><i class="fas fa-shopping-cart"></i> <a href="{{URL::to('/don-hang')}}">Đơn hàng</a></li>
							<li><i class="ti-user"></i> <a href="{{URL::to('/tai-khoan-cua-toi')}}">Tài khoản của tôi</a></li>
							<li><i class="ti-power-off"></i><a href="{{URL::to('/dang-xuat')}}">Đăng xuất</a></li>
							@else
							<li><i class="ti-user"></i> <a href="dangki-kh">Đăng kí</a></li>
							<li><i class="ti-power-off"></i><a href="{{URL::to('/dangnhap-kh')}}">Đăng nhập</a></li>
							@endif
						</ul>
					</div>
					<!-- End Top Right -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Topbar -->
	<div class="middle-inner">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-12">
					<!-- Logo -->
					<div class="logo">
						<a href="index.html"><img src="theme/images/logo.png" alt="logo"></a>
					</div>
					<!--/ End Logo -->
				</div>
				<div class="col-lg-8 col-md-7 col-12">
					<div class="search-bar-top">
						<div class="search-bar">
							<form action="{{URL::to('/loc-sach')}}" method="get">
								<input name="search" placeholder="Tìm kiếm..." type="search">
								<button class="btnn"><i class="ti-search"></i></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<div class="right-bar" style="margin-top: 15px; top:0px;">
						<!-- Search Form -->
						<div id="change-cart">
							<div class="sinlge-bar shopping">
								<a href="gio-hang" class="single-icon">
									<button type="button" class="btn btn-light"> GIỎ HÀNG
										<i class="fas fa-shopping-cart"></i>
										<span class="total-count">{{ $count }}</span>
									</button>
								</a>
								<!-- Shopping Item -->

								<div class="shopping-item">
									<div class="dropdown-cart-header">
										<span>SÁCH TRONG GIỎ HÀNG</span>
									</div>

									@if($tongtien !=0)
									@foreach ($sachs as $key => $sach)
									<ul class="shopping-list">
										<li>
											<a class="remove" title="Remove this item" data-id="{{ $sach->rowId }}"><i class="fa fa-remove"></i></a>
											<a class="cart-img" href="#"><img src="<?php
												if(file_exists('public/uploads/anhsach/'.$sach->options->image)){
												echo 'public/uploads/anhsach/'.$sach->options->image;
												}else{
													echo $sach->options->image;
												}
												?>" alt="#"></a>
											<h4><a href="#">{{ $sach->name }}</a></h4>
											<p class="quantity">{{ $sach->qty }} X <span class="amount">{{ number_format($sach->price) }} VND</span></p>
										</li>
									</ul>
									@endforeach
									<div class="bottom">
										<div class="total">
											<span>Tổng cộng</span>
											<span class="total-amount">{{ $tongtien }} VND</span>
										</div>
										<a href="gio-hang" class="btn animate">XEM GIỎ HÀNG</a>
									</div>
									@else
									<p> Không có sản phẩm nào trong giỏ hàng! </p>
									@endif
								</div>

							</div>
							<!--/ End Shopping Item -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Header Inner -->
	<div class="header-inner">
		<div class="container">
			<div class="cat-nav-head">
				<div class="row">
					<div class="col-lg-3">
						<div class="all-category">
							<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>DANH MỤC SÁCH</h3>
							<ul class="main-category" id="main-cate" style="display: none">
								<li><a href="#">Thể Loại <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									<ul class="sub-category">
										@foreach ($list_theloai as $key => $theloai)
										<li><a href="loc-sach?theloai={{$theloai->id_tl}}">{{ $theloai->ten_tl }}</a></li>
										@endforeach
									</ul>
								</li>
								<li><a href="#">Tác giả <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									<ul class="sub-category">
										@foreach ($list_tacgia as $key => $tacgia)
										<li><a href="#">{{ $tacgia->ten_tg }}</a></li>
										@endforeach
									</ul>
								</li>
								<li><a href="#">Nhà xuất bản <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									<ul class="sub-category">
										@foreach ($list_nxb as $key => $nxb)
										<li><a href="#">{{ $nxb->ten_nxb }}</a></li>
										@endforeach
									</ul>
								</li>
								<li><a href="#">Nhà cung cấp <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									<ul class="sub-category">
										@foreach ($list_ncc as $key => $ncc)
										<li><a href="#">{{ $ncc->ten_ncc }}</a></li>
										@endforeach
									</ul>
								</li>
								<li class="main-mega"><a href="#">Ngôn ngữ<i class="fa fa-angle-right" aria-hidden="true"></i></a>
									<ul class="sub-category">
										<li><a href="#">Tiếng Việt</a></li>
										<li><a href="#">Tiếng Anh</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-9 col-12">
						<div class="menu-area">
							<!-- Main Menu -->
							<nav class="navbar navbar-expand-lg" style="margin-bottom: 0px;border-top-width: 0px;border-bottom-width: 0px;border-right-width: 0px;border-left-width: 0px;">
								<div class="navbar-collapse">
									<div class="nav-inner">
										<ul class="nav main-menu menu navbar-nav">
											<li class="active"><a href="#">Trang chủ</a></li>
											<li><a href="loc-sach">Sản phẩm</a></li>
											<li><a href="gio-hang">Giỏ hàng</a></li>

										</ul>
									</div>
								</div>
							</nav>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Header Inner -->
</header>