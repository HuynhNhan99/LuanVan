@extends('index')
@section('noidung')
<?php

use Gloudemans\Shoppingcart\Facades\Cart;

$sachs = Cart::content();
$tongtien = Cart::subtotal();
$count = Cart::count();
?>
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="/"><i class="fas fa-home"></i>Trang chủ </i></a></li>
						<li class="active"><a href="blog-single.html" style="padding-left: 10px;">Giỏ hàng</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

@if($tongtien !=0)
<div class="shopping-cart section" style="padding-top: 0px;">
	<div class="container" id="list-cart">
		<div class="row">
			<div class="col-12" style="padding-top: 15px;">
				<!-- Shopping Summery -->
				<table class="table shopping-summery">
					<thead>
						<tr class="main-hading">
							<th>HÌNH</th>
							<th>TÊN SÁCH</th>
							<th class="text-center">GIÁ SÁCH</th>
							<th class="text-center">GIẢM GIÁ</th>
							<th class="text-center">SỐ LƯỢNG</th>
							<th class="text-center">TỔNG TIỀN</th>
							<th class="text-center">XÓA</th>

						</tr>
					</thead>
					<tbody>
						@foreach ($sachs as $key => $sach)
						<tr>
							<td class="image" data-title="No"><img src="<?php
																		if (file_exists('public/uploads/anhsach/' . $sach->options->image)) {
																			echo 'public/uploads/anhsach/' . $sach->options->image;
																		} else {
																			echo $sach->options->image;
																		}
																		?>" alt="#"></td>

							<td class="product-des" data-title="Description" style="width:450px;">
								<p class="product-name"><a href="#">{{ $sach->name }}</a></p>
								<p class="product-des"></p>
							</td>
							<td class="price" data-title="Price"><span>{{ number_format($sach->price*100/(100-$sach->weight)) }}</span></td>
							@if($sach->weight!=0)
							<td class="price" data-title="Price"> - {{ $sach->weight }}% </td>
							@else
							<td class="price" data-title="Price">{{ $sach->weight }} </td>
							@endif
							<td class="qty" data-title="Qty" style="text-align: center;">
								<!-- Input Order -->
								<div class="input-group">
									<div class="button minus">
										<button type="button" class="btn btn-primary btn-number" onclick="save_down('{{ $sach->rowId}}')" data-type="minus" data-field="quant[{{$key}}]">
											<i class="ti-minus"></i>
										</button>
									</div>
									<input type="text" id="qty-{{ $sach->rowId}}" name="quant[{{$key}}]" class="input-number" data-min="1" data-max="100" value="{{ $sach->qty }}">
									<div class="button plus">
										<button type="button" class="btn btn-primary btn-number" onclick="save_up('{{ $sach->rowId}}')" data-type="plus" data-field="quant[{{$key}}]">
											<i class="ti-plus"></i>
										</button>
									</div>
								</div>
								<!--/ End Input Order -->
							</td>
							<td class="total-amount" data-title="Total"><span>{{ number_format($sach->qty * $sach->price) }}</span></td>
							<td class="action" data-title="Remove"><a class="remove" title="Remove this item" data-id="{{ $sach->rowId }}"><i class="ti-trash remove-icon" style="cursor: pointer;"></i></a></td>

						</tr>
						@endforeach

					</tbody>
				</table>
				<!--/ End Shopping Summery -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Total Amount -->
				<div class="total-amount">
					<div class="row">
						<div class="col-lg-8 col-md-5 col-12">

						</div>
						<div class="col-lg-4 col-md-7 col-12">
							<div class="right">
								<ul>
									<li>Tạm tính<span>{{$tongtien}} đ</span></li>
									<li class="last">Thành tiền<span style="font-size: 25px; color:#f7941d ;">{{$tongtien}} đ</span></li>
									<li><span style="font-size: 13px; color:#9e9d9d;">(Đã bao gồm VAT nếu có)</span></li>
								</ul>
								<div class="button5">
									<a href="xacnhan-dc" class="btn">TIẾN HÀNH ĐẶT HÀNG</a>
									<a href="/" class="btn">TIẾP TỤC MUA HÀNG</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ End Total Amount -->
			</div>
		</div>
	</div>
</div>
@else
<div style="box-shadow: 0 1px 1px 0 rgba(0,0,0,.05);border-radius: .125rem;overflow: hidden;background: #fff;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-pack: center;justify-content: center;-webkit-box-align: center;align-items: center;width: 100%;background:white;margin-top: .75rem;">
	<div style="text-align: center;background-position: 50%;background-size: 200px;background-repeat: no-repeat;background-image: url(https://salt.tikicdn.com/desktop/img/mascot@2x.png);width: 100%;height: 100%;margin-bottom: 1.25rem;filter: grayscale(70%);">
	<a href="/"><button type="button"  style="color: white;background: #333;border-radius: 0px;margin-top:260px;padding-top: 10px;padding-bottom: 10px;padding-right: 20px;padding-left: 20px;"> Tiếp tục mua hàng
                    </button></a>
</div>
	
</div>
@endif
@endsection