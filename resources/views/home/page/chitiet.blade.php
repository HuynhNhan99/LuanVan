@extends('index')
@section('noidung')
<?php

use Illuminate\Support\Facades\Session;

$kh = Session::get('id_kh');

if(isset($sl_ban)){
	$slban = $sl_ban->soluong;
}else{
	$slban = 0;
}

?>
<div class="container-fluid" style="background: #f9f9f9; padding-right: 0px;padding-left: 0px;">
	<div class="breadcrumbs" style="background: white;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="/"><i class="fas fa-home"></i>Trang chủ</a></li>
							<li class="active"><a href="blog-single.html" style="padding-left:10px;">Chi tiết sách</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12 padding-right" style="padding-left: 0px;padding-right: 0px;">
				<div class="product-details">
					<!--product-details-->
					<div class="col-md-5" style="padding-right: 0px;">
						<div class="view-product" style="background: white;text-align: center;">
							<img src="<?php
										if (file_exists('public/uploads/anhsach/' . $sach->hinh_anh)) {
											echo 'public/uploads/anhsach/' . $sach->hinh_anh;
										} else {
											echo $sach->hinh_anh;
										}
										?>" alt="">
						</div>
					</div>

					<div class="col-md-7" style="padding-left: 10px;">
						<form style="background: white;">
							{{ csrf_field() }}
							<div class="product-information">
								<!--/product-information-->
								<div class="row">
									<p style="font-size: 12px;"><b>Tác giả:</b> {{$sach->ten_tg}} | <b>Thể loại:</b> {{$sach->ten_tl}}</p>
								</div>
								<div class="row">
									<h1>{{ $sach->ten_sach }}</h1>
								</div>
								<div class="row">
									<p></p>
								</div>
								<div class="row">
									@for($n=1;$n<=5;$n++) <?php
															if ($n <= $danhgia) {
																$color = "color:#ffcc00;";
															} else {
																$color = "color:#ccc;";
															}
															?> <i class="fa fa-star" style=" {{$color}}; font-size:16px;"></i>
										@endfor
										<p> ( {{$tong_dg}} đánh giá)</p>
								</div>
								<div class="row">
									<?php
									if(isset($sach->phantram_km)){
										echo '<span style="margin-top: 20px;margin-bottom: 20px;">'.number_format( (100-$sach->phantram_km)*$sach->gia_sach/100) .'đ</span>
											<span style="color:#b3b3b3;font-size:18px;font-weight: 400;margin-top: 20px;margin-bottom: 20px;text-decoration: line-through;opacity: .6;margin-right: 2px;">'.number_format($sach->gia_sach) .'đ</span>
											<span style="color:red;font-size:18px;font-weight: 400;margin-top: 20px;margin-bottom: 20px;margin-left: 10px;">- '.$sach->phantram_km.'%</span>
											<input type="hidden" value='.$sach->phantram_km.' id="km"  name="phantram_km" />';
									}else{
										echo '<span style="margin-top: 20px;margin-bottom: 20px;">'.number_format( $sach->gia_sach) .'đ</span>
										<input type="hidden" value="0" id="km" name="phantram_km" />';
									}
									?>
									
								</div>
								<div class="row"> Số lượng:
								</div>
								<div class="row">
									<div class="input-group" style="width: 150px;">
										<div class="button minus" style="display: inline-block;position: absolute;top: 0;left: 0;border-radius: 0;overflow: hidden;">
											<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[1]">
												<i class="ti-minus"></i>
											</button>
										</div>
										<input type="text" name="quant[1]" class="input-number" data-min="1" data-max="{{$sach->sl_nhap - $slban}}" id="qty" value="1" style="border: 1px solid #eceded;width: 100%;text-align: center;height: 47px;border-radius: 0;overflow: hidden;padding: 0px 45px;">
										<div class="button plus" style="    display: inline-block;position: absolute;top: 0;right: 0;border-radius: 0;overflow: hidden;">
											<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
												<i class="ti-plus"></i>
											</button>
										</div>
									</div>
								</div>
								@if($sach->sl_nhap - $slban<=0)
								<div class="row">
									<div class="input-group">
										<button type="button" class="btn btn-fefault cart " >
											 HẾT HÀNG
										</button>
									</div>
								</div>
								@else
								<div class="row">
									<div class="input-group">
										<button type="button" class="btn btn-fefault cart addcart" data-id="{{ $sach->id_sach }}">
											<i class="fa fa-shopping-cart"></i> THÊM VÀO GIỎ HÀNG
										</button>
									</div>
								</div>
								@endif

							</div>
						</form>
						<!--/product-information-->
					</div>

				</div>
				<!--/product-details-->

				<div class="category-tab shop-details-tab">
					<!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#chitiet" data-toggle="tab" class="active">Thông tin chi tiết</a></li>
							<li><a href="#mota" data-toggle="tab">Mô tả sản phẩm</a></li>
						</ul>
					</div>
					<div class="col-sm-12 tab-content" style="background: white; padding:10px;">
						<div class="tab-pane fade active in" id="chitiet">
							<div class="table">
								<table style="margin-bottom: 0px;">
									<tbody>
										<tr>
											<td>Nhà cung cấp</td>
											<td>{{$sach->ten_ncc}}</td>
										</tr>
										<tr>
											<td>Kích thước</td>
											<td>
												<p>{{$sach->chieu_rong}} x {{$sach->chieu_dai}} cm</p>
											</td>
										</tr>

										<tr>
											<td>Số trang</td>
											<td>{{$sach->so_trang}}</td>
										</tr>
										<tr>
											<td>SKU</td>
											<td>5075886035946</td>
										</tr>
										<tr>
											<td>Nhà xuất bản</td>
											<td>{{$sach->ten_nxb}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="tab-pane fade" id="mota">
							@if($sach->mo_ta)
							<div class="col">
								<p style="color:black; font-size:14px;">{{$sach->mo_ta}}</p>
							</div>
							@else
							<div class="col" style="height: 200px;">
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="row" id="reviews">
					<div class="col-sm-12" style="margin-bottom:20px;  background: white;">
						<div class="rating-content" style="display: flex; align-items:center;">
							<div class="rating-item" style="width:20%;border-right: 1px solid #ccc;display: flex;flex-direction: column;align-items: center;">
								<div style="font-size: 20px;line-height: 40px;margin: 0px 0px 4px;">Đánh giá</div>
								<div style="font-size: 33px;line-height: 40px;margin: 0px 0px 4px;">{{$danhgia}}</div>
								<div style="position: relative;z-index: 1;display: inline-block;">
									@for($i=1;$i<=5;$i++) <span class="fa fa-star" style="color:#ffcc00"></span>
										@endfor
								</div>
							</div>
							<div class=" list-rating" style="width:60%; padding:20px;">
								@foreach ($danh_gia as $key => $dg1)
								<div class="rating-item" style="display:flex; align-items: center;">
									<div style="width:10%">{{$key}} <span class="fa fa-star"></span></div>
									<div style="width:70%; margin:0 20px;">
										<span style="width:100%; height:8px; display:block; border: 1px solid #ccc;background-color:#ccc;">
											<?php
											//nếu chưa đánh giá thì tổng đánh giá =0
											if ($tong_dg == 0) {
												$color = 0;
											} else {
												$color = ($dg1['sodiem'] / $tong_dg) * 100;
											}
											echo '<style type="text/css">
											b.mau-' . $key . ' {
											width: ' . $color . '%;
											}
											</style>';
											?>
											<b style=" background-color:#ffcc00; display:block;height:100%;" class="mau-{{$key}}"></b>
										</span>
									</div>
									<div style="width:20%">
										({{$dg1['sodiem']}} đánh giá)
									</div>
								</div>
								@endforeach
							</div>
							@if($kh)
							<div style="width:20%">
								<button type="button" class="btn btn-default js-danh-gia">Đánh giá</button>
							</div>
							@else
							<div style="width:20%">
								<a href="{{URL::to('/dangnhap-kh')}}" style="color: blue;">Đăng nhập</a> để đánh giá !!!
							</div>
							@endif
						</div>
					</div>

					<div class="col-sm-12 hide" id="rating-action" style="margin-bottom: 20px; background: white; padding:15px;">
						<p>Chọn đánh giá của bạn: </p>
						<ul class="list-inline rating" title="rating" style="margin-bottom: 0px;">
							<div id="rating">
								<input type="radio" id="star5" name="rating" value="5" />
								<label class="full" for="star5" title="Awesome - 5 stars"></label>

								<input type="radio" id="star4" name="rating" value="4" />
								<label class="full" for="star4" title="Pretty good - 4 stars"></label>

								<input type="radio" id="star3" name="rating" value="3" />
								<label class="full" for="star3" title="Meh - 3 stars"></label>

								<input type="radio" id="star2" name="rating" value="2" />
								<label class="full" for="star2" title="Kinda bad - 2 stars"></label>

								<input type="radio" id="star1" name="rating" value="1" />
								<label class="full" for="star1" title="Sucks big time - 1 star"></label>
							</div>

							<input type="hidden" value="{{$sach->id_sach}}" class="sach-id" />
						</ul>
						<form action="#">
							<textarea name="" cols="30" row="3" id="noi-dung"></textarea>
							<button type="button" class="btn btn-default pull-right" id="danhgia">Gửi đánh giá</button>
						</form>
					</div>
					<div class="col-sm-12 " id="rating-show" style="padding: 20px 20px 0px 20px; margin-bottom: 30px; background: white;">
						@foreach ($kh_dg as $key => $dg)
						<div class="row">
							<div class="col-2" style="font-weight:bold;font-size: 15px">
								{{$dg->ten_kh}}
							</div>
							<div class="col-10">
								<div>

									@for($n=1;$n<=5;$n++) <?php
															if ($n <= $dg->diem_dg) {
																$color = "color:#ffcc00;";
															} else {
																$color = "color:#ccc;";
															}
															?> <span class="fa fa-star rating" style="cursor:pointer; {{$color}} font-size:15px;"></span>
										@endfor
								</div>
								<div style="color: #b3b3b3;">{{$dg->ngay_dg}}</div>
								<div style="padding:20px 0px 20px 0px;">{{$dg->noi_dung}}</div>
							</div>
						</div>
						<hr />
						@endforeach
						<nav aria-lable="Page navigation">
							{!! $kh_dg->links() !!}
						</nav>
					</div>
				</div>
			</div>
			<!--/category-tab-->
		</div>

		<div class="col-sm-12 padding-right" style="padding:20px; background: white;">
			<div class="js">
				<!--recommended_items-->
				<h2 class="title text-center" style="margin-bottom: 0px;">Sách tương tự</h2>
				<div class="product-area most-popular section" style="padding-top: 0px;padding-bottom: 30px;">
					<div class="row">
						<div class="col-12">
							<div class="owl-carousel popular-slider">
								@foreach ($sach_tuongtu as $key => $sach)
								<div class="single-product" style="margin-top: 30px;">
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
								@endforeach
								<!-- End Single Product -->
							</div>
						</div>
					</div>
				</div>


			</div>
			<!--/recommended_items-->

		</div>

	</div>
</div>



@endsection