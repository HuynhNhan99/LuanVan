<table class="table table-hover" id="tim-tl">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên thể loại</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $list_theloai as $key => $theloai)
        <tr>
            <td> {{ $key+1 }}</td>
            <td>{{ $theloai->ten_tl}}</td>
            <td>
                <a href="{{URL::to('/edit-theloai/'.$theloai->id_tl)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{URL::to('/delete-theloai/'.$theloai->id_tl)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>