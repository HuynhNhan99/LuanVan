<table class="table table-hover" id="topsach">
    <thead>
        <tr>
            <th>TOP</th>
            <th>TÊN SÁCH</th>
            <th>GIÁ SÁCH</th>
            <th>SỐ LƯỢNG BÁN ĐƯỢC</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $top10 as $key => $sach)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $sach->ten_sach }}</td>
            <td>{{ $sach->gia_sach }}</td>
            <td>{{ $sach->soluong }}</td>
        </tr>
        @endforeach

    </tbody>
</table>