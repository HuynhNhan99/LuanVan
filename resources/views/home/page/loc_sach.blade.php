@extends('home.page.list')
@section('danhsach')
<div class="col-lg-9 col-md-8 col-12" style="background: white;">
    <div class="row">
        <div class="col-12" style="padding-left: 2px;padding-right: 0px;">

            <!-- Shop Top -->
            <div class="shop-top">
                <div class="shop-shorter">
                    <h2>NHBook</h2>
                    <?php
                    if (isset($_GET["theloai"])) {
                        foreach ($dausach1 as $key => $sach){
                            $a= $sach->ten_tl;
                        }
                        echo 'Tiêu chí tìm kiếm: <span class="tieuchi">Thể loại: '.$a.' </span>';
                    } elseif (isset($_GET["danhgia"])) {
                        echo 'Tiêu chí tìm kiếm: <span class="tieuchi">Đánh giá: Từ '.$_GET["danhgia"].' sao</span>';
                    } elseif (isset($_GET["tacgia"])) {
                        foreach ($dausach1 as $key => $sach){
                            $a= $sach->ten_tg;
                        }
                        echo 'Tiêu chí tìm kiếm: <span class="tieuchi">Tác giả: '.$a.'</span>';
                    } elseif (isset($_GET["giatu"])) {
                        echo 'Tiêu chí tìm kiếm: <span class="tieuchi">Giá:</span>';
                    } elseif (isset($_GET["search"])) {
                        echo 'Tiêu chí tìm kiếm: <span class="tieuchi">Tìm kiếm: '.$_GET["search"].'</span>';
                    }
                    ?>
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
                    <a href="/chitiet-sach/{{ $sach['id_sach'] }}">
                        <img class="default-img" src="<?php
                                                        if (file_exists('public/uploads/anhsach/' . $sach['hinh_anh'])) {
                                                            echo 'public/uploads/anhsach/' . $sach['hinh_anh'];
                                                        } else {
                                                            echo $sach['hinh_anh'];
                                                        }
                                                        ?>" alt="#" >
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
        </div>
        @endforeach
    </div>
    <div>
        {!! $dausach1->links("pagination::bootstrap-4") !!}
    </div>
</div>
@endsection