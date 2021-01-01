<table id="recent-purchases-listing" class="table dataTable no-footer timkiemkho" role="grid">
    <thead>
        <tr>
            <th></th>
            <th>Tên Sách</th>
            <th>Giá Sách</th>
            <th>Số lượng nhập </th>
            <th>Số lượng tồn</th>
            <th>Chi tiết</th>
            <th>Thêm số lượng</th>

        </tr>
    </thead>
    <tbody>
        @foreach( $list_kho as $key => $sach)
        {{ csrf_field() }}
        <tr>
            <td style="width:40px"><img src="<?php
                                                if (file_exists('public/uploads/anhsach/' . $sach['hinh_anh'])) {
                                                    echo 'public/uploads/anhsach/' . $sach['hinh_anh'];
                                                } else {
                                                    echo $sach['hinh_anh'];
                                                }
                                                ?>" atl="" style="width: 50px; height: 50px; border-radius: 0%;" /></td>
            <td style="text-align: left;width:300px">{{ $sach['ten_sach']}}</td>
            <td>{{$sach['gia_sach']}}</td>
            <td>{{$sach['sl_nhap']}}</td>
            <td>{{$sach['sl_ton']}}</td>
            <td><a href="{{URL::to('addmin/ct-kho/'.$sach['id_sach'])}}"><i class="fas fa-info-circle"></i></a></td>
            <td><button type="button" class="open-AddBookDialog btn right btn-primary" data-toggle="modal" data-id="{{$sach['id_sach']}}" data-target="#Themncc" data-id="{{$sach['id_sach']}}" style="width:100%; height:100%">Thêm</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>