<?php

use Gloudemans\Shoppingcart\Facades\Cart;

$sachs = Cart::content();
$tongtien = Cart::subtotal();
$count = Cart::count();
?>
<div class="sinlge-bar shopping">
    <a href="#" class="single-icon">
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