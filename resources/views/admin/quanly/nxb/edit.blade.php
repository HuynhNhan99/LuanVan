@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CẬP NHẬT NHÀ XUẤT BẢN</h4>
                    @foreach( $edit_nxb as $key => $nxb)
                    <form class="forms-sample" action="{{URL::to('addmin/update-nxb/'.$nxb->id_nxb)}}" method="post">
                        {{ csrf_field() }}    
                        <div class="form-group">
                            <label for="MoTa">Tên Nhà xuất bản</label>
                            <input type="text" class="form-control" id="TenNXB" name="ten_nxb" value="{{ $nxb->ten_nxb }}" required />
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                        <button class="btn btn-light" >Thoát</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection