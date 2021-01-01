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
                        <a href="addmin/quanly-kho">
                            <p class="text-primary mb-0 hover-cursor">Quản lý kho sách</p>
                        </a>
                        <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;Chi tiết kho sách</p>
                        <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;{{$tenkm->ten_km}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-10">
                            <h4 class="card-title">CHI TIẾT KHUYẾN MÃI</h4>
                        </div>
                        <div class="col-lg-2">
                            <a href=""><button type="button" class="btn right btn-primary" style="width:100%; height:100%">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="timkiemkho">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th></th>
                                    <th>Tên Sách</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $ctkm as $key => $sach)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td style="width:40px"><img src="<?php
                                                                        if (file_exists('public/uploads/anhsach/' . $sach->hinh_anh)) {
                                                                            echo 'public/uploads/anhsach/' . $sach->hinh_anh;
                                                                        } else {
                                                                            echo $sach->hinh_anh;
                                                                        }
                                                                        ?>" atl="" style="width: 50px; height: 50px; border-radius: 0%;" /></td>
                                    <td style="text-align: left;">{{ $sach->ten_sach}}</td>

                                    <td>
                                        <a href="{{URL::to('addmin/ctkm-sach/'.$sach->id_sach)}}">
                                            <i class="fas fa-trash "></i>
                                        </a>
                                    </td>
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