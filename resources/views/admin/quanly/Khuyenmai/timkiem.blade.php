<table class="table table-hover" id="tim-km">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên chương trình khuyến mãi</th>
            <th>Giảm giá</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Chi tiết </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $km as $key => $khuyenmai)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $khuyenmai->ten_km }}</td>
            <td>{{ $khuyenmai->phantram_km }}%</td>
            <td>{{ $khuyenmai->ngay_bat_dau }}</td>
            <td>{{ $khuyenmai->ngay_ket_thuc }}</td>
            <td><a href="{{URL::to('/chitiet-km/'.$khuyenmai->id_km)}}"><i class="fas fa-info-circle"></i></a></td>
            <td>
                <a href="{{URL::to('/edit-ncc/'.$khuyenmai->id_km)}}"><i class="fa fa-edit"></i></a>
                <a href="{{URL::to('/delete-ncc/'.$khuyenmai->id_km)}}"><i class="fas fa-trash "></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>