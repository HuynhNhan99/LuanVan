@extends('home')
@section('noidung')
<!-- Start Product Area -->
<div class="product-area most-popular section" style="padding-top: 0px;">
	<div class="container">
		<div class="row" style="height: 50px;margin-top: 50px;">
			<div class="col-12">
				<div class="section-title row" style="text-align: left;">
					<h2>SÁCH MỚI</h2>
					<div class="coming-time" style="position: absolute; text-align:right">
								<div class="clearfix row" data-countdown="2020/12/30">
									<div class="cdown "><span class="days"><p><strong>76</strong>Days.</p>
										</span></div>
									<div class="cdown"><span class="hour"><p><strong> 23</strong>Hours.</p>
										</span></div>
									<div class="cdown"><span class="minutes"><p><strong>33</strong>MINUTES.</p>
										</span></div>
									<div class="cdown"><span class="second"><p><strong> 11</strong>SECONDS.</p>
										</span></div>
								</div>
							</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="owl-carousel popular-slider">
					<!-- Start Single Product -->
					@foreach ($dausach as $key => $sach)
					<div class="single-product">
						<div class="product-img">
							<a href="/chitiet-sach/{{ $sach['id_sach'] }}">
								<img class="default-img" src="<?php
																if (file_exists('public/uploads/anhsach/' . $sach['hinh_anh'])) {
																	echo 'public/uploads/anhsach/' . $sach['hinh_anh'];
																} else {
																	echo $sach['hinh_anh'];
																}
																?>" alt="#" style="margin-left: 38px;">
								<span class="new">Mới</span>
							</a>


						</div>
						<div class="product-content">
							<h3><a href="/chitiet-sach/{{ $sach['id_sach']  }}">{{ $sach['ten_sach']  }}</a></h3>
							<div style="padding-left: 10px;">
								@for($n=1;$n<=5;$n++) <?php
														if ($n <= $sach['diemtb']) {
															$color = "color:#ffcc00;";
														} else {
															$color = "color:#ccc;";
														}
														?> <i class="fa fa-star" style=" {{$color}}; font-size:10px;"></i>
									@endfor
									({{ $sach['soluong']}} nhận xét)</div>
							<div class="product-price">
								<?php
								if ($sach['khuyenmai'] != 0) {
									echo '<p class="text_info" style="color:red;padding-left: 0px;font-weight:550;font-size:18px;">' . number_format((100 - $sach['khuyenmai']) * $sach['gia_sach'] / 100) . ' đ  <span style="color:black;">-' . $sach['khuyenmai'] . '%</span> </p>';
								} else {
									echo '<h3 class="text_info" style="color:red;padding-left: 0px;">' . number_format($sach['gia_sach']) . ' đ</h3>
															';
								}
								?>

							</div>

						</div>
					</div>
					@endforeach
					<!-- End Single Product -->

				</div>
			</div>
		</div>
	</div>
</div>
<section class="shop-home-list section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>On sale</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
								<p class="price with-discount">$59</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$44</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$89</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Best Seller</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$65</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$33</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$77</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Top viewed</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$22</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$35</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$99</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
		</div>
	</div>
</section>
<!-- End Product Area -->
<div class="product-area section" style="padding-top: 0px;">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title" style="margin-bottom:50px;">
					<h2>SÁCH TIẾNG VIỆT</h2>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="product-info">
					<div class="nav-main" style="text-align: center;">
						<!-- Tab Nav -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#man" role="tab" aria-selected="true">Văn học</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#women" role="tab" aria-selected="false">Kỹ năng sống</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kids" role="tab">Kinh dị</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#accessories" role="tab">Tiểu thuyết</a></li>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#essential" role="tab">Khoa hoc</a></li>
						</ul>
						<!--/ End Tab Nav -->
					</div>
					<div class="tab-content" id="myTabContent">
						<!-- Start Single Tab -->
						<div class="tab-pane fade active show" id="man" role="tabpanel">
							<div class="tab-single">
								<div class="row">


									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Black Sunglass For Women</a></h3>
												<div class="product-price">
													<span class="old">$60.00</span>
													<span>$50.00</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
						<!-- Start Single Tab -->
						<div class="tab-pane fade" id="women" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Hot Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Pink Show</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="new">New</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Pant Collectons</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="price-dec">30% Off</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Cap For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Polo Dress For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Black Sunglass For Women</a></h3>
												<div class="product-price">
													<span class="old">$60.00</span>
													<span>$50.00</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
						<!-- Start Single Tab -->
						<div class="tab-pane fade" id="kids" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Hot Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Pink Show</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="new">New</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Pant Collectons</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="price-dec">30% Off</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Cap For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Polo Dress For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Black Sunglass For Women</a></h3>
												<div class="product-price">
													<span class="old">$60.00</span>
													<span>$50.00</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
						<!-- Start Single Tab -->
						<div class="tab-pane fade" id="accessories" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Hot Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Pink Show</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="new">New</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Pant Collectons</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="price-dec">30% Off</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Cap For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Polo Dress For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Black Sunglass For Women</a></h3>
												<div class="product-price">
													<span class="old">$60.00</span>
													<span>$50.00</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
						<!-- Start Single Tab -->
						<div class="tab-pane fade" id="essential" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Hot Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Pink Show</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="new">New</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Pant Collectons</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="price-dec">30% Off</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Cap For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Polo Dress For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Black Sunglass For Women</a></h3>
												<div class="product-price">
													<span class="old">$60.00</span>
													<span>$50.00</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
						<!-- Start Single Tab -->
						<div class="tab-pane fade" id="prices" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Hot Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Pink Show</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="new">New</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Women Pant Collectons</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Bags Collection</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="price-dec">30% Off</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Awesome Cap For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Polo Dress For Women</a></h3>
												<div class="product-price">
													<span>$29.00</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="product-details.html">
													<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
													<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>
												<div class="button-head">
													<div class="product-action">
														<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
														<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
														<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
													</div>
													<div class="product-action-2">
														<a title="Add to cart" href="#">Add to cart</a>
													</div>
												</div>
											</div>
											<div class="product-content">
												<h3><a href="product-details.html">Black Sunglass For Women</a></h3>
												<div class="product-price">
													<span class="old">$60.00</span>
													<span>$50.00</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/ End Single Tab -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="shop-home-list section">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>On sale</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
								<p class="price with-discount">$59</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$44</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$89</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Best Seller</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$65</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$33</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$77</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
			<div class="col-lg-4 col-md-6 col-12">
				<div class="row">
					<div class="col-12">
						<div class="shop-section-title">
							<h1>Top viewed</h1>
						</div>
					</div>
				</div>
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$22</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$35</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
				<!-- Start Single List  -->
				<div class="single-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="list-image overlay">
								<img src="https://via.placeholder.com/115x140" alt="#">
								<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12 no-padding">
							<div class="content">
								<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
								<p class="price with-discount">$99</p>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single List  -->
			</div>
		</div>
	</div>
</section>

<section class="cown-down">
	<div class="section-inner ">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-12 padding-right">
					<div class="image">
						<img src="https://via.placeholder.com/750x590" alt="#">
					</div>
				</div>
				<div class="col-lg-6 col-12 padding-left">
					<div class="content">
						<div class="heading-block">
							<p class="small-title">Deal of day</p>
							<h3 class="title">Beatutyful dress for women</h3>
							<p class="text">Suspendisse massa leo, vestibulum cursus nulla sit amet, frungilla placerat lorem. Cars fermentum, sapien. </p>
							<h1 class="price">$1200 <s>$1890</s></h1>
							<div class="coming-time">
								<div class="clearfix" data-countdown="2020/12/30">
									<div class="cdown"><span class="days"><strong>76</strong>
											<p>Days.</p>
										</span></div>
									<div class="cdown"><span class="hour"><strong> 23</strong>
											<p>Hours.</p>
										</span></div>
									<div class="cdown"><span class="minutes"><strong>33</strong>
											<p>MINUTES.</p>
										</span></div>
									<div class="cdown"><span class="second"><strong> 11</strong>
											<p>SECONDS.</p>
										</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="product-area section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>SÁCH BÁN CHẠY</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="product-info">
					<div class="tab-content" id="myTabContent">
						<!-- Start Single Tab -->
						<div class="tab-pane fade show active" role="tabpanel">
							<div class="tab-single">
								<div class="row">
									@foreach ($dausach as $key => $sach)
									<div class="col-xl-3 col-lg-4 col-md-4 col-12">
										<div class="single-product">
											<div class="product-img">
												<a href="/chitiet-sach/{{ $sach['id_sach'] }}">
													<img class="default-img" src="<?php
																					if (file_exists('public/uploads/anhsach/' . $sach['hinh_anh'])) {
																						echo 'public/uploads/anhsach/' . $sach['hinh_anh'];
																					} else {
																						echo $sach['hinh_anh'];
																					}
																					?>" alt="#">
													<span class="out-of-stock">Hot</span>
												</a>

											</div>
											<div class="product-content">
												<h3><a href="/chitiet-sach/{{ $sach['id_sach']  }}">{{ $sach['ten_sach']  }}</a></h3>
												<div style="padding-left: 10px;">
													@for($n=1;$n<=5;$n++) <?php
																			if ($n <= $sach['diemtb']) {
																				$color = "color:#ffcc00;";
																			} else {
																				$color = "color:#ccc;";
																			}
																			?> <i class="fa fa-star" style=" {{$color}}; font-size:10px;"></i>
														@endfor
														({{ $sach['soluong']}} nhận xét)</div>
												<div class="product-price">
													<?php
													if ($sach['khuyenmai'] != 0) {
														echo '<span class="old">' . number_format($sach['gia_sach']) . '  đ</span>  -' . $sach['khuyenmai'] . '% 
															<h3 class="text_info" style="color:red;padding-left: 0px;">' . number_format((100 - $sach['khuyenmai']) * $sach['gia_sach'] / 100) . ' đ</h3>
															';
													} else {
														echo '<h3 class="text_info" style="color:red;padding-left: 0px;">' . number_format($sach['gia_sach']) . ' đ</h3>
															';
													}
													?>

												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection