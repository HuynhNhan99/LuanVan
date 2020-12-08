@extends('home.page.list')
@section('danhsach')
<?php

if(isset($_GET["theloai"])){
    $a="Thể loại";
}elseif(isset($_GET["danhgia"])){
    $a="Đánh giá";
}elseif(isset($_GET["tacgia"])){
    $a="Tác giả";
}elseif(isset($_GET["giatu"])){
    $a="Giá";
}elseif(isset($_GET["search"])){
    $a="Tìm kiếm";
}


?>
<div class="col-lg-9 col-md-8 col-12" style="background: white;">
    <div class="row" >
        <div class="col-12" style="padding-left: 2px;padding-right: 0px;">
        
            <!-- Shop Top -->
            <div class="shop-top">
                <div class="shop-shorter">
                    <h2>NHBook</h2>
                    Tiêu chí tìm kiếm: <span class="tieuchi">{{$a}}:</span>
                </div>
            </div>
            
            <!--/ End Shop Top -->
        </div>
    </div>
    <div class="row">
        @foreach ($dausach as $key => $sach)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="single-product">
                <div class="product-img">
                    <a href="chitiet-sach/{{$sach->id_sach}}">
                        <img class="default-img" src="<?php
                                                        if (file_exists('public/uploads/anhsach/' . $sach->hinh_anh)) {
                                                            echo 'public/uploads/anhsach/' . $sach->hinh_anh;
                                                        } else {
                                                            echo $sach->hinh_anh;
                                                        }
                                                        ?>" alt="#">
                    </a>
                </div>
                <div class="product-content">
                    <h3><a href="chitiet-sach/{{$sach->id_sach}}">{{$sach->ten_sach}}</a></h3>
                    <div class="product-price">
                        <span class="old">{{ number_format($sach->gia_sach) }} đ</span>
                        <span class="text_info" style="color:red;font-size: 1.75rem; font-weight: 550;">{{ number_format($sach->gia_sach) }} đ</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
<div>
{!! $dausach->links("pagination::bootstrap-4") !!}
</div>
</div>
@endsection