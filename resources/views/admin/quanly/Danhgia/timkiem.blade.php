<table class="table table-hover" id="tim-dg">
    <thead>
        <tr>
            <th>STT</th>
            <th>TÊN KHÁCH HÀNG</th>
            <th>TÊN SÁCH</th>
            <th>ĐIỂM</th>
            <th>NỘI DUNG</th>
            <th>TRẠNG THÁI</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $danhgia as $key => $dg)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $dg->ten_kh }}</td>
            <td style="text-align: left;">{{ $dg->ten_sach }}</td>
            <td>{{ $dg->diem_dg }}</td>
            <td>{{ $dg->noi_dung }}</td>
            @if($dg->tt==0)
            <td><a href="addmin/ql-danhgia?tt={{$dg->tt}}&id_dg={{$dg->id_dg}}"><label class="badge badge-danger" style="cursor: pointer;">Ẩn</label></a></td>
            @else
            <td><a href="addmin/ql-danhgia?tt={{$dg->tt}}&id_dg={{$dg->id_dg}}"><label class="badge badge-primary" style="cursor: pointer;">Hiện</label></a></td>
            @endif
            <!-- <td><a href=""><i class="mdi mdi-arrow-down-bold" style="font-size: x-large;color: red;"></i></a></td> -->
        </tr>
        @endforeach
    </tbody>
</table>