<table class="table table-hover" id="tim-nxb">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên nhà xuất bản</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $list_nxb as $key => $nxb)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $nxb->ten_nxb }}</td>
            <td>
                <a href="{{URL::to('addmin/edit-nxb/'.$nxb->id_nxb)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{URL::to('addmin/delete-nxb/'.$nxb->id_nxb)}}">
                    <i class="fas fa-trash "></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>