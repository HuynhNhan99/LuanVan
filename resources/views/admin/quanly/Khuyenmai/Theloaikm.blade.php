<table class="table table-hover" id="tlkm">
    <thead>
        <tr>
            <th style="width:80px; font-size: 14px;">CHỌN</th>
            <th style="font-size: 14px;">TÊN SÁCH</th>
            <th style=" font-size: 14px;">TÊN THỂ LOẠI</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $list_theloai as $key => $tl)
        <tr>
            <td><input class="w3-check" type="checkbox" name="id_sach[]" value="{{$tl->id_sach}}"></td>
            <td style="text-align: left;">{{$tl->ten_sach}}</td>
            <td>{{$tl->ten_tl}}</td>
        </tr>
    @endforeach

    </tbody>
</table>