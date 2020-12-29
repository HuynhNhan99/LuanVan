<table class="table table-hover" id="tim-phi">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Thành phố</th>
            <th>Tên Quận huyện</th>
            <th>Tên Xã phường</th>
            <th>Phí ship</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $phivc as $key => $phi)
        {{ csrf_field() }}
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $phi->tentp }}</td>
            <td>{{ $phi->tenqh }}</td>
            <td>{{ $phi->tenxa }}</td>
            <td contenteditable data-ship_id="{{$phi->ma_phi}}" class="phi-ship">{{ number_format($phi->phi_vc) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>