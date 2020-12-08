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
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6">
              <h4 class="card-title">DANH SÁCH CÁC ĐẦU SÁCH</h4>
            </div>
            <div class="col-lg-6">
            </div>
          </div>
          <div class="row" style="margin-bottom: 20px;">
            {{ csrf_field() }}

            <div class="col-lg-4">
              <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <span class="input-group-text red lighten-3" id="basic-text1" style="color: white; background:#4d83ff;border-color: #4d83ff;"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                </div>
              </div>
            </div>
            <div class="col-lg-2">
              <select class="form-control" id="sapxepdh" style="width:100%;">
                <option value="0">--- Trạng thái --- </option>
                <option value="1">Trạng thái ẩn</option>
                <option value="2">Trạng thái hiện</option>
              </select>
            </div>
            <div class="col-lg-2">
              <select class="form-control" id="sapxepdh" style="width:100%;">
                <option value="0">--- Sắp xếp --- </option>
                <option value="1">Theo giá</option>
                <option value="2">Theo tên</option>
                <option value="3">Theo ngày nhập</option>
              </select>
            </div>
            <div class="col-lg-1">
              <button type="button" class="btn right btn-primary " style="width:100%;padding-right: 10px;padding-left: 10px;height: 46.22222px;" data-toggle="modal" data-target="#ImportSach">Import</button>
            </div>
            <div class="col-lg-1">
              <a href="{{URL::to('/export-sach')}}" style="color: #f4f7fa; "><button type="button" class="btn right btn-primary " style="width:100%;padding-right: 10px;padding-left: 10px;height: 46.22222px;">Export</button></a>
            </div>
            <div class="col-lg-2">
              <button type="button" class="btn right btn-primary " style="width:100%;"><a href="{{URL::to('/add-sach')}}" style="color: #f4f7fa; ">Thêm mới <i class="fas fa-plus"></i></a></button>
            </div>

          </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th style="width: 30px;">STT</th>
                  <th colspan="2" style="width: 340px;">Tên sách</th>
                  <th style="width: 30px;">Giá</th>
                  <th style="width: 300px;">Tóm tắm</th>
                  <th style="width: 100px;">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $list_sach as $key => $sach)
                <tr>
                  <td >{{ $key+1 }}</td>
                  <td style="width:40px"><img src="<?php
                                                      if (file_exists('public/uploads/anhsach/' . $sach->hinh_anh)) {
                                                        echo 'public/uploads/anhsach/' . $sach->hinh_anh;
                                                      } else {
                                                        echo $sach->hinh_anh;
                                                      }
                                                      ?>" atl="" style="width: 50px; height: 50px; border-radius: 0%;" /></td>
                  <td style="text-align: left;width:300px">{{ $sach->ten_sach}}</td>
                  <td >{{ $sach->gia_sach}}</td>
                  <td> <p style=" text-align: left;white-space: nowrap;width: 300px; overflow: hidden;text-overflow: ellipsis; ">{{ $sach->mo_ta}}</p></td>
                  <td>
                    <a href="{{URL::to('/edit-sach/'.$sach->id_sach)}}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{URL::to('/delete-sach/'.$sach->id_sach)}}">
                      <i class="fas fa-trash "></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div >
{!! $list_sach->links("pagination::bootstrap-4") !!}
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Thêm -->
<div class="modal fade" id="ImportSach" tabindex="-1" role="dialog" aria-labelledby="ImportSach" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ImportSach">THÊM SÁCH BẰNG FILE EXCEL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="forms-sample" action="{{URL::to('/import-sach')}}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="importsach">Import file Sách</label>
            <input type="file" class="form-control-file" name="import_sach">
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