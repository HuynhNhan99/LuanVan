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
                        <p class="text-primary mb-0 hover-cursor">Quản lý phí vận chuyển</p>
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
                            <h4 class="card-title">Danh sách phí vận chuyển</h4>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search" id="timphi1">
                                <div class="input-group-append">
                                    <button class="input-group-text red lighten-3" id="timphi" style="color: white; background:#4d83ff;border-color: #4d83ff; "><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn right btn-primary" data-toggle="modal" data-target="#Thempvc" style="width:100%; height:100%">Thêm mới</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tim-phi">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Thành phố</th>
                                    <th>Tên Quận huyện</th>
                                    <th>Tên Xã phường</th>
                                    <th>Phí ship</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $phivc as $key => $phi)
                                {{ csrf_field() }}
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $phi->tentp }}</td>
                                    <td>{{ $phi->tenqh }}</td>
                                    <td>{{ $phi->tenxa }}</td>
                                    <td contenteditable data-ship_id="{{$phi->ma_phi}}" class="phi-ship">{{ number_format($phi->phi_vc) }}</td>
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

<!-- Thêm -->
<div class="modal fade" id="Thempvc" tabindex="-1" role="dialog" aria-labelledby="Thempvc" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Thempvc">THÊM PHÍ VẬN CHUYỂN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="{{URL::to('addmin/them-phivc')}}" method="post">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="Tinh/TP"><strong>Tỉnh/Thành phố:</strong></label>
                        <select class="form-control choose thanhpho" name="matp" id="thanhpho">
                            <option>-----Tỉnh/Thành phố----</option>
                            @foreach($thanhpho as $key =>$city)
                            <option value="{{$city->matp}}">{{$city->tentp}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Tinh/TP"><strong>Quận huyện:</strong></label>
                        <select class="form-control choose quanhuyen" name="maqh" id="quanhuyen">
                            <option>-----Quận huyện----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Tinh/TP"><strong>Phường xã:</strong></label>
                        <select class="form-control xaphuong" name="maxa" id="xaphuong">
                            <option>-----Phường xã----</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Phi"><strong>Phí vận chuyển</strong></label>
                        <input type="text" class="form-control" name="phi_vc" required />
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