<?php

use Gloudemans\Shoppingcart\Facades\Cart;

$sachs = Cart::content();
$tongtien = Cart::subtotal();
$count = Cart::count();
?>
<div class="row">
    <div class="col-12" style="padding-top: 15px;">
        <!-- Shopping Summery -->
        <table class="table shopping-summery">
            <thead>
                <tr class="main-hading">
                    <th>HÌNH</th>
                    <th>TÊN SÁCH</th>
                    <th class="text-center">GIÁ SÁCH</th>
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
                    <td class="product-des" data-title="Description">
                        <p class="product-name"><a href="#">{{ $sach->name }}</a></p>
                        <p class="product-des">Maboriosam in a tonto nesciung eget distingy magndapibus.</p>
                    </td>
                    <td class="price" data-title="Price"><span>{{ number_format($sach->price) }}</span></td>
                    <td class="qty" data-title="Qty">
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
                    <td class="action" data-title="Remove"><a class="remove" title="Remove this item" data-id="{{ $sach->rowId }}"><i class="ti-trash remove-icon"></i></a></td>

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
                            <li class="last">Thành tiền<span style="font-size: 25px; color:rgb(24, 158, 255);">{{$tongtien}} đ</span></li>
                            <li><span style="font-size: 13px; color:#9e9d9d;">(Đã bao gồm VAT nếu có)</span></li>
                        </ul>
                        <div class="button5">
                            <a href="dat-hang" class="btn">TIẾN HÀNH ĐẶT HÀNG</a>
                            <a href="/" class="btn">TIẾP TỤC MUA HÀNG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Total Amount -->
    </div>
</div>