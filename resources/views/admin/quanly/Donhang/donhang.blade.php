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
            <p class="text-primary mb-0 hover-cursor">Danh sách các đơn hàng</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">DANH SÁCH CÁC ĐƠN HÀNG</h4>
          <div class="row" style="margin-bottom: 20px;">
            <div class="col-lg-6">
              <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Tìm kiếm đơn hàng theo tên khách hàng" aria-label="Search" id="timdh1">
                <div class="input-group-append">
                  <button class="input-group-text red lighten-3" id="timdh" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
            {{ csrf_field() }}
            <div class="col-lg-3">
              <select class="form-control locdh" id="locdh" style="width:100%;">
                <option value="0">--- Tất cả đơn hàng --- </option>
                <option value="1">Đơn hàng chưa xác nhận </option>
                <option value="2">Đơn hàng đã xác nhận</option>
                <option value="3">Đơn hàng đang giao</option>
                <option value="4">Đơn hàng đã giao</option>
                <option value="5">Đơn hàng đã hủy</option>
              </select>
            </div>
            <div class="col-lg-3">
              <select class="form-control" id="sapxepdh" style="width:100%;">
                <option value="0">--- Sắp xếp --- </option>
                <option value="1">Theo ngày đặt</option>
                <option value="2">Theo tổng tiền</option>
                <option value="3">Theo trạng thái ĐH</option>
              </select>
            </div>

          </div>
          <div class="table-responsive" id="loc-dh">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>NGƯỜI ĐẶT</th>
                  <th>NGÀY ĐẶT</th>
                  <th>TỔNG TIỀN</th>
                  <th>TRẠNG THÁI</th>
                  <th>XEM CHI TIẾT</th>
                  <th>DUYỆT ĐƠN HÀNG</th>
                </tr>
              </thead>
              <tbody id="getdh">
                @foreach( $donhang as $key => $dh)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $dh->ten_kh }}</td>
                  <td>{{ $dh->ngay_dat }}</td>
                  <td>{{ number_format($dh->tong_tien,0,',','.') }} đ</td>
                  @if ($dh->trang_thai == 1)
                  <td><label class="badge badge-danger">Chờ xác nhận</label></td>
                  @elseif ($dh->trang_thai == 2)
                  <td><label class="badge badge-primary">Đã xác nhận</label></td>
                  @elseif ($dh->trang_thai == 3)
                  <td><label class="badge badge-warning">Đang giao</label></td>
                  @elseif ($dh->trang_thai == 4)
                  <td><label class="badge badge-success">Đã giao</label></td>
                  @else
                  <td><label class="badge badge-info">Đã hủy</label></td>
                  @endif
                  <td style="text-align: center;"><a href="{{URL::to('/ct-donhang/'.$dh->id_dh)}}"><i class="fas fa-info-circle"></i></a></td>
                  <td>
                    <form action="{{URL::to('/duyet-dh/'.$dh->id_dh)}}" method="post">
                      {{ csrf_field() }}
                      <select id="id_tt" name="id_tt">
                        @if ($dh->trang_thai == 1)
                        <option>Duyệt đơn hàng </option>
                        <option value="2">Xác nhận</option>
                        <option value="5">Hủy đơn hàng</option>
                        @elseif ($dh->trang_thai == 2)
                        <option>Duyệt đơn hàng </option>
                        <option value="3">Giao hàng</option>
                        <option value="5">Hủy đơn hàng</option>
                        @elseif ($dh->trang_thai == 3)
                        <option>Duyệt đơn hàng </option>
                        <option value="4">Đã giao</option>
                        @elseif ($dh->trang_thai == 5)
                        <option>Đã hủy đơn hàng </option>
                        @else
                        <option>Hoàn thành đơn hàng</option>
                        @endif
                      </select>
                      <button type="submit">Duyệt</button>
                    </form>
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