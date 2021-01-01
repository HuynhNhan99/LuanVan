@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">THÊM CHƯƠNG TRÌNH KHUYẾN MÃI</h4>
                    <form class="forms-sample" action="{{URL::to('addmin/add-km')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="tenSach">Tên chương trình khuyến mãi</label>
                                    <input type="text" class="form-control" id="TenSach" name="ten_km" required />
                                </div>
                                <div class="col-4">
                                    <label for="giaSach">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" id="giaSach" name="ngay_bat_dau" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label for="tenSach">Mức giảm (%)</label>
                                    <input type="text" class="form-control" id="TenSach" name="phamtram_km" required />
                                </div>
                                <div class="col-4">
                                    <label for="giaSach">Ngày kết thúc</label>
                                    <input type="date" class="form-control" id="giaSach" name="ngay_ket_thuc" required />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection