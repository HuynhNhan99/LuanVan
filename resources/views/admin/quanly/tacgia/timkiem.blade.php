<table class="table table-hover" id="tim-tg">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Tác giả</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $list_tacgia as $key => $tacgia)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $tacgia->ten_tg}}</td>
            <td>
                <a href="{{URL::to('addmin/edit-tacgia/'.$tacgia->id_tg)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{URL::to('addmin/delete-tacgia/'.$tacgia->id_tg)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>