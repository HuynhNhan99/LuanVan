@extends('index')
@section('noidung')
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="/"><i class="fas fa-home"></i>Trang chủ <i class="fas fa-angle-right"></i></i></a></li>
						<li class="active"><a href="blog-single.html">Đơn hàng</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->
<div class="shopping-cart section" style="padding-top: 5px;padding: 0px;">
	<div class="container" id="list-cart">
		<div class="category-tab shop-details-tab" style="margin-top:10px;">
			<!--category-tab-->
			<div class="col-sm-12">
				<ul class="nav nav-tabs" style="background: white;margin:0px;">
					<li style="text-align: center;width: 221px;"><a href="#choxacnhan" data-toggle="tab" class="active">Chờ xác nhận</a></li>
					<li style="text-align: center;width: 221px;"><a href="#xacnhan" data-toggle="tab">Đã xác nhận</a></li>
					<li style="text-align: center;width: 221px;"><a href="#danggiao" data-toggle="tab">Đang giao</a></li>
					<li style="text-align: center;width: 221px;"><a href="#dagiao" data-toggle="tab">Đã giao</a></li>
					<li style="text-align: center;width: 221px;"><a href="#dahuy" data-toggle="tab">Đã hủy</a></li>
				</ul>
			</div>
			<div class="col-sm-12">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="choxacnhan">
						@if(!$donhang1->isEmpty())
						<table class="table" style="margin-top: 10px; background: white; ">
							<thead>
								<tr>
									<th> ĐƠN HÀNG</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">STT</th>
									<th scope="col" style="text-align: center;">NGÀY ĐẶT</th>
									<th scope="col" style="text-align: center;">TỔNG TIỀN</th>
									<th scope="col" style="text-align: center;">XEM CHI TIẾT</th>
									<th scope="col" style="text-align: center;">HỦY ĐƠN HÀNG</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($donhang1 as $key => $sach)
								<tr>
									<td scope="row" style="text-align: center;"> {{$key+1}}</td>
									<td scope="row" style="text-align: center;"><span>{{ $sach->ngay_dat }}</span></td>
									<td scope="row" style="text-align: center;">{{ $sach->tong_tien }}</td>
									<td style="text-align: center;"><a href="{{URL::to('/chitietdh/'.$sach->id_dh)}}"><i class="fas fa-info-circle"></i></a></td>
									<td style="text-align: center;"><a href="{{URL::to('/xoadh/'.$sach->id_dh)}}"><i class="fas fa-times"></i></a></td>
								</tr>
								@endforeach
							</tbody>

						</table>
						@else
						<div style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);border-radius: .125rem;overflow: hidden;background: #fff;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;width: 100%;background:white;height: 37.5rem;margin-top: .75rem;">
							<div style="background-position: 50%;background-size: 150px;background-repeat: no-repeat;background-image: url(https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/50ae7a4bf7cca69985b40dfea02eddb3.png);width: 100%;height: 100%;margin-bottom: 1.25rem;">
							</div>
						</div>
						@endif
					</div>
					<div class="tab-pane fade" id="xacnhan">
						@if(!$donhang2->isEmpty())

						<table class="table" style="margin-top: 10px; background: white; ">
							<thead>
								<tr>
									<th> ĐƠN HÀNG</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">STT</th>
									<th scope="col" style="text-align: center;">NGÀY ĐẶT</th>
									<th scope="col" style="text-align: center;">TỔNG TIỀN</th>
									<th scope="col" style="text-align: center;">XEM CHI TIẾT</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($donhang2 as $key => $sach)
								<tr>
									<td scope="row" style="text-align: center;"> {{$key+1}}</td>
									<td scope="row" style="text-align: center;"><span>{{ $sach->ngay_dat }}</span></td>
									<td scope="row" style="text-align: center;">{{ $sach->tong_tien }}</td>
									<td style="text-align: center;"><a href="{{URL::to('/chitietdh/'.$sach->id_dh)}}"><i class="fas fa-info-circle"></i></a></td>
								</tr>
								@endforeach
							</tbody>

						</table>
						@else
						<div style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);border-radius: .125rem;overflow: hidden;background: #fff;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;width: 100%;background:white;height: 37.5rem;margin-top: .75rem;">
							<div style="background-position: 50%;background-size: 150px;background-repeat: no-repeat;background-image: url(https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/50ae7a4bf7cca69985b40dfea02eddb3.png);width: 100%;height: 100%;margin-bottom: 1.25rem;">
							</div>
						</div>
						@endif
					</div>

					<div class="tab-pane fade" id="danggiao">
						@if(!$donhang3->isEmpty())
						<table class="table" style="margin-top: 10px; background: white; ">
							<thead>
								<tr>
									<th> ĐƠN HÀNG</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">STT</th>
									<th scope="col" style="text-align: center;">NGÀY ĐẶT</th>
									<th scope="col" style="text-align: center;">TỔNG TIỀN</th>
									<th scope="col" style="text-align: center;">XEM CHI TIẾT</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($donhang3 as $key => $sach)
								<tr>
									<td scope="row" style="text-align: center;"> {{$key+1}}</td>
									<td scope="row" style="text-align: center;"><span>{{ $sach->ngay_dat }}</span></td>
									<td scope="row" style="text-align: center;">{{ $sach->tong_tien }}</td>
									<td style="text-align: center;"><a href="{{URL::to('/chitietdh/'.$sach->id_dh)}}"><i class="fas fa-info-circle"></i></a></td>
								</tr>
								@endforeach
							</tbody>

						</table>
						@else
						<div style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);border-radius: .125rem;overflow: hidden;background: #fff;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;width: 100%;background:white;height: 37.5rem;margin-top: .75rem;">
							<div style="background-position: 50%;background-size: 150px;background-repeat: no-repeat;background-image: url(https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/50ae7a4bf7cca69985b40dfea02eddb3.png);width: 100%;height: 100%;margin-bottom: 1.25rem;">
							</div>
						</div>
						@endif
					</div>

					<div class="tab-pane fade " id="dagiao">
						@if(!$donhang4->isEmpty())
						<table class="table" style="margin-top: 10px; background: white; ">
							<thead>
								<tr>
									<th> ĐƠN HÀNG</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">STT</th>
									<th scope="col" style="text-align: center;">NGÀY ĐẶT</th>
									<th scope="col" style="text-align: center;">TỔNG TIỀN</th>
									<th scope="col" style="text-align: center;">XEM CHI TIẾT</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($donhang4 as $key => $sach)
								<tr>
									<td scope="row" style="text-align: center;"> {{$key+1}}</td>
									<td scope="row" style="text-align: center;"><span>{{ $sach->ngay_dat }}</span></td>
									<td scope="row" style="text-align: center;">{{ $sach->tong_tien }}</td>
									<td style="text-align: center;"><a href="{{URL::to('/chitietdh/'.$sach->id_dh)}}"><i class="fas fa-info-circle"></i></a></td>
								</tr>
								@endforeach
							</tbody>

						</table>
						@else
						<div style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);border-radius: .125rem;overflow: hidden;background: #fff;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;width: 100%;background:white;height: 37.5rem;margin-top: .75rem;">
							<div style="background-position: 50%;background-size: 150px;background-repeat: no-repeat;background-image: url(https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/50ae7a4bf7cca69985b40dfea02eddb3.png);width: 100%;height: 100%;margin-bottom: 1.25rem;">
							</div>
						</div>
						@endif
					</div>
					<div class="tab-pane fade " id="dahuy">

						@if(!$donhang5->isEmpty())
						<table class="table" style="margin-top: 10px; background: white; ">
							<thead>
								<tr>
									<th> ĐƠN HÀNG</th>
								</tr>
								<tr>
									<th scope="col" style="text-align: center;">STT</th>
									<th scope="col" style="text-align: center;">NGÀY ĐẶT</th>
									<th scope="col" style="text-align: center;">TỔNG TIỀN</th>
									<th scope="col" style="text-align: center;">XEM CHI TIẾT</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($donhang5 as $key => $sach)
								<tr>
									<td scope="row" style="text-align: center;"> {{$key+1}}</td>
									<td scope="row" style="text-align: center;"><span>{{ $sach->ngay_dat }}</span></td>
									<td scope="row" style="text-align: center;">{{ $sach->tong_tien }}</td>
									<td style="text-align: center;"><a href="{{URL::to('/chitietdh/'.$sach->id_dh)}}"><i class="fas fa-info-circle"></i></a></td>
								</tr>
								@endforeach
							</tbody>

						</table>
						@else
						<div style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);border-radius: .125rem;overflow: hidden;background: #fff;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;width: 100%;background:white;height: 37.5rem;margin-top: .75rem;">
							<div style="background-position: 50%;background-size: 150px;background-repeat: no-repeat;background-image: url(https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/50ae7a4bf7cca69985b40dfea02eddb3.png);width: 100%;height: 100%;margin-bottom: 1.25rem;">
							</div>
						</div>
						@endif
					</div>

				</div>
			</div>
		</div>
	</div>
</div>


@endsection