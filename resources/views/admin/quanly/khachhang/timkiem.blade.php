<table class="table table-hover" id="tim-kh">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>Giới tính</th>
            <th>Số điện thoại</th>
            <th>email</th>
            <th>username</th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $khachhang as $key => $kh)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $kh->ten_kh }}</td>
            <td><?php if ($kh->gioi_tinh == 0) echo 'nữ';
                else echo 'nam';
                ?></td>
            <td>{{ $kh->sdt_kh }}</td>
            <td>{{ $kh->email_kh }}</td>
            <td>{{ $kh->name }}</td>
            <td>
                <a href="{{URL::to('addmin/delete-khachhang/'.$kh->id_kh)}}"><i class="fas fa-trash "></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>