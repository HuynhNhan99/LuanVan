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
                        <p class="text-primary mb-0 hover-cursor">Quản lý kho sách</p>
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
                        <div class="col-lg-7">
                            <h4 class="card-title">QUẢN LÝ KHO HÀNG</h4>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timkho1">
                                <div class="input-group-append">
                                    <button class="input-group-text red lighten-3" id="timkho" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table dataTable no-footer timkiemkho" role="grid">
                            <thead>
                                <tr >
                                    <th colspan="2" style="width: 340px;">Tên Sách</th>
                                    
                                    <th >Số lượng nhập </th>
                                    <th >Số lượng tồn</th>
                                    <th >Chi tiết</th>
                                    <th >Thêm số lượng</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $list_kho as $key => $sach)
                                {{ csrf_field() }}
                                <tr>
                                    <td style="width:40px"><img src="<?php
                                                                        if (file_exists('public/uploads/anhsach/' . $sach['hinh_anh'])) {
                                                                            echo 'public/uploads/anhsach/' . $sach['hinh_anh'];
                                                                        } else {
                                                                            echo $sach['hinh_anh'];
                                                                        }
                                                                        ?>" atl="" style="width: 50px; height: 50px; border-radius: 0%;" /></td>
                                    <td style="text-align: left;width:300px">{{ $sach['ten_sach']}}</td>
                                   
                                    <td>{{$sach['sl_nhap']}}</td>
                                    <td>{{$sach['sl_ton']}}</td>
                                    <td><a href="{{URL::to('addmin/ct-kho/'.$sach['id_sach'])}}"><i class="fas fa-info-circle"></i></a></td>
                                    <td><button type="button" class="open-AddBookDialog btn right btn-primary" data-toggle="modal" data-id="{{$sach['id_sach']}}" data-target="#Themncc" data-id="{{$sach['id_sach']}}" style="width:100%; height:100%">Thêm</button>
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

<div class="modal fade" id="Themncc" tabindex="-1" role="dialog" aria-labelledby="Themncc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Themncc">Thêm số lượng sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{URL::to('addmin/them-kho')}}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="TrangThai">Số lượng</label>
                        <input class="form-control" id="sl_nhap" name="sl_nhap"></input>
                        <input class="form-control" type="hidden" id="id_sach" name="id_sach"></input>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection