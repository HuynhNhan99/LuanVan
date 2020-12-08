<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Giá sách</th>
            <th>Tóm tắt</th>
            <th>Số trang</th>
            <th>Chiều dài</th>
            <th>Chiều rộng</th>
            <th>Tác giả</th>
            <th>Thể loại</th>
            <th>Nhà xuất bản</th>
            <th>Hình ảnh</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($khachhang as $key => $kh)
        <tr>
            <th>{{$key+1}}</th>
            <th>{{$kh->ten_sach}}</th>
            <th>{{$kh->gia_sach}}</th>
            <th>{{$kh->mo_ta}}</th>
            <th>{{$kh->so_trang}}</th>
            <th>{{$kh->chieu_dai}}</th>
            <th>{{$kh->chieu_rong}}</th>
            <th>{{$kh->ten_tg}}</th>
            <th>{{$kh->ten_tl}}</th>
            <th>{{$kh->ten_nxb}}</th>
            <th>{{$kh->hinh_anh}}</th>
        </tr>
    @endforeach
    </tbody>
</table>