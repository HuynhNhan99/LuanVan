@extends('index')
@section('noidung')
<!-- Preloader -->
<!-- Breadcrumbs -->
<div class="breadcrumbs" style="line-height: 23px;">
	<div class="container-fluid" style="padding-right: 100px;padding-left: 100px;">
		<div class="row">
			<div class="col-12" style="padding-left: 3px;">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="/"><i class="fas fa-home"></i>Trang chủ</i></a></li>
						<li class="active" style="padding-left: 10px;"><a href="blog-single.html">Các loại sách</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->
<!-- Product Style -->
<section class="product-area shop-sidebar shop section" style="padding-top: 5px;background:#f3f3f3;">
	<div class="container-fluid" style="padding-right: 100px;padding-left: 100px;">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-12">
				<div class="shop-sidebar">
					<!-- Sach -->
					<div class="single-widget category">
						<h3 class="title">SÁCH</h3>
						<ul class="categor-list">
							<li><a href="/loc-sach?name=1">Sách mới nhất</a></li>
							<li><a href="">Sách bán chạy nhất</a></li>
						</ul>
					</div>
					
					<!-- theo đánh giá-->
					<div class="single-widget category">
						<h3 class="title">ĐÁNH GIÁ</h3>
						<ul class="categor-list">
							<a href="/loc-sach?danhgia=5">
								<p style="font-size: 16px; display: inline-block;">
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
								</p> <span class="text">từ 5 sao</span>
							</a>
							<a href="/loc-sach?danhgia=4">
								<p style="font-size: 16px; display: inline-block;">
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ccc"></i>
								</p> <span class="text">từ 4 sao</span>
							</a>
							<a href="/loc-sach?danhgia=3">
								<p style="font-size: 16px; display: inline-block;">
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ffcc00"></i>
									<i class="fa fa-star" style="color:#ccc"></i>
									<i class="fa fa-star" style="color:#ccc"></i>
								</p> <span class="text">từ 3 sao</span>
							</a>
						</ul>
					</div>
					<div class="single-widget category">
						<h3 class="title">GIÁ</h3>
						<ul class="categor-list">
							<form action="{{URL::to('/loc-sach')}}" method="get">
							<div class="input-group">
								<input pattern="[0-9]*" placeholder="Giá từ"  class="locgia1" name="giatu">
								<span class="ngang">-</span>
								<input pattern="[0-9]*" placeholder="Giá đến"  class="locgia2" name="giaden">
							</div>
							<button type="submit" class="nutloc">OK</button>
							</form>
						</ul>
					</div>
					<!-- theo thể loại-->
					<div class="single-widget category">
						<h3 class="title">THỂ LOẠI</h3>
						<ul class="categor-list">
							@foreach ($list_theloai as $key => $theloai)
							<li><a href="/loc-sach?theloai={{$theloai->id_tl}}">{{$theloai->ten_tl}}</a></li>
							@endforeach
						</ul>
					</div>
					<!-- theo tác giả-->
					<div class="single-widget category">
						<h3 class="title">TÁC GIẢ</h3>
						<ul class="categor-list">
							@foreach ($list_tacgia as $key => $tacgia)
							<li><a href="/loc-sach?tacgia={{$tacgia->id_tg}}">{{$tacgia->ten_tg}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			@yield('danhsach');
		</div>
	</div>
</section>
<!--/ End Product Style 1  -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<!-- Product Slider -->
						<div class="product-gallery">
							<div class="quickview-slider-active">
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
							</div>
						</div>
						<!-- End Product slider -->
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="quickview-content">
							<h2>Flared Shift Dress</h2>
							<div class="quickview-ratting-review">
								<div class="quickview-ratting-wrap">
									<div class="quickview-ratting">
										<i class="yellow fa fa-star"></i>
										<i class="yellow fa fa-star"></i>
										<i class="yellow fa fa-star"></i>
										<i class="yellow fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<a href="#"> (1 customer review)</a>
								</div>
								<div class="quickview-stock">
									<span><i class="fa fa-check-circle-o"></i> in stock</span>
								</div>
							</div>
							<h3>$29.00</h3>
							<div class="quickview-peragraph">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
							</div>
							<div class="size">
								<div class="row">
									<div class="col-lg-6 col-12">
										<h5 class="title">Size</h5>
										<select>
											<option selected="selected">s</option>
											<option>m</option>
											<option>l</option>
											<option>xl</option>
										</select>
									</div>
									<div class="col-lg-6 col-12">
										<h5 class="title">Color</h5>
										<select>
											<option selected="selected">orange</option>
											<option>purple</option>
											<option>black</option>
											<option>pink</option>
										</select>
									</div>
								</div>
							</div>
							<div class="quantity">
								<!-- Input Order -->
								<div class="input-group">
									<div class="button minus">
										<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
											<i class="ti-minus"></i>
										</button>
									</div>
									<input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
									<div class="button plus">
										<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
											<i class="ti-plus"></i>
										</button>
									</div>
								</div>
								<!--/ End Input Order -->
							</div>
							<div class="add-to-cart">
								<a href="#" class="btn">Add to cart</a>
								<a href="#" class="btn min"><i class="ti-heart"></i></a>
								<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
							</div>
							<div class="default-social">
								<h4 class="share-now">Share:</h4>
								<ul>
									<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal end -->
@endsection