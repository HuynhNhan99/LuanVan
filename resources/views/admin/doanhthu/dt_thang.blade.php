@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Danh sách các đầu sách</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-9">
                            <p class="card-title">BIỂU ĐỒ DOANH THU MỖI THÁNG</p>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control locdh" style="width:100%;">
                                <option value="0">--- 2020 --- </option>
                                <option value="1">2010 </option>

                            </select>
                        </div>
                    </div>
                    <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                    <canvas id="barChart" width="666" height="333" class="chartjs-render-monitor" style="display: block; width: 666px; height: 333px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection