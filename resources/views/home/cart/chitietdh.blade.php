@extends('index')
@section('noidung')
<div class="container">
    <table class="table" style="margin-top: 30px; ">
        <thead>
            <tr>
                <th>CHI TIẾT ĐƠN HÀNG </th>
            </tr>
            <tr>
                <th scope="col" style="text-align: center;">HÌNH</th>
                <th scope="col" style="text-align: center;">TÊN SÁCH</th>
                <th scope="col" style="text-align: center;">GIÁ SÁCH</th>
                <th scope="col" style="text-align: center;">SỐ LƯỢNG</th>
                <th scope="col" style="text-align: center;">THÀNH TIỀN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ctdonhang as $key => $sach)
            <tr>
                <td scope="row" style="text-align: center;"><img src="public/uploads/anhsach/{{ $sach->hinh_anh }}" style="width:50px;"></td>
                <td scope="row">
                    <h4>{{ $sach->ten_sach }}</h4>
                </td>
                <td scope="row" style="text-align: center;"><span>{{ number_format($sach->gia_sach) }}</span></td>
                <td scope="row" style="text-align: center;">{{ $sach->so_luong }}</td>
                <td style="text-align: center;"><span>{{ number_format($sach->so_luong * $sach->gia_sach) }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection