@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CẬP NHẬT TÁC GIẢ</h4>
                    @foreach( $edit_tacgia as $key => $tacgia)
                    <form class="forms-sample" action="{{URL::to('/update-tacgia/'.$tacgia->id_tg)}}" method="post">
                        {{ csrf_field() }}    
                        <div class="form-group">
                            <label for="MoTa">Tên Tác giả</label>
                            <input type="text" class="form-control" id="TenNXB" name="ten_tg" value="{{ $tacgia->ten_tg }}" required />
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