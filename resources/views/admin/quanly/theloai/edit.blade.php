@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CẬP NHẬT TÁC GIẢ</h4>
                    @foreach( $edit_theloai as $key => $theloai)
                    <form class="forms-sample" action="{{URL::to('/update-theloai/'.$theloai->id_tl)}}" method="post">
                        {{ csrf_field() }}    
                        <div class="form-group">
                            <label for="MoTa">Tên thể loại</label>
                            <input type="text" class="form-control" id="TenTL" name="ten_tl" value="{{ $theloai->ten_tl }}" required />
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