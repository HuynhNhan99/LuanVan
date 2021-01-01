@extends('admin.index')
@section('noidung')
<?php foreach ($top10 as $key => $sach)
                            $thang = $sach->thang;
                        $nam = $sach->nam;
                        ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Top sách bán chạy nhất tháng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: contents;">
        <div class="card">
            <div class="card-body">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <h4 class="card-title">SỐ LƯỢNG CUỐN SÁCH BÁN ĐƯỢC TRONG THÁNG </h4>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-lg-5">

                    </div>
                    {{ csrf_field() }}
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control" id="topthang" style="width:100%;">
                            <option>---Tháng {{$thang}}---</option>
                            @for($i=1;$i<=12;$i++) <option value="{{$i}}">Tháng {{$i}}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control" id="sapxepdh" style="width:100%;">
                            <option value="0">---Năm {{$nam}}---</option>
                        </select>
                    </div>
                </div>
                <canvas id="pieChart" data-sl="{{json_encode($sl_sach)}}" data-sach="{{json_encode($ten_sach)}}" class="chartjs-render-monitor" style="display: block; width: 532px; height: 265px;">
                </canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">TOP CUỐN SÁCH BÁN CHẠY NHẤT TRONG THÁNG</h4>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-5">

                        </div>
                        {{ csrf_field() }}
                        <div class="col-lg-3">
                            <?php foreach ($top10 as $key => $sach)
                                $thang = $sach->thang;
                            $nam = $sach->nam;
                            ?>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control" id="topthang" style="width:100%;">
                                <option>---Tháng---</option>
                                @for($i=1;$i<=12;$i++) <option value="{{$i}}">Tháng {{$i}}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control" id="sapxepdh" style="width:100%;">
                                <option value="0">Năm {{$nam}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="topsach">
                            <thead>
                                <tr>
                                    <th>TOP</th>
                                    <th>TÊN SÁCH</th>
                                    <th>GIÁ SÁCH</th>
                                    <th>SỐ LƯỢNG BÁN ĐƯỢC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $top10 as $key => $sach)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $sach->ten_sach }}</td>
                                    <td>{{ $sach->gia_sach }}</td>
                                    <td>{{ $sach->soluong }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection