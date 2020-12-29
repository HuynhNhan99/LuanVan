<table class="table table-hover" id="tim-ncc">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên nhà cung cấp</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $list_ncc as $key => $ncc)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $ncc->ten_ncc }}</td>
            <td>{{ $ncc->sdt_ncc }}</td>
            <td>{{ $ncc->email_ncc }}</td>
            <td>{{ $ncc->diachi_ncc }}</td>
            <td>
                <a href="{{URL::to('/edit-ncc/'.$ncc->id_ncc)}}"><i class="fa fa-edit"></i></a>
                <a href="{{URL::to('/delete-ncc/'.$ncc->id_ncc)}}"><i class="fas fa-trash "></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>