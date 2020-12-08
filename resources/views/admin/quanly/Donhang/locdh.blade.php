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