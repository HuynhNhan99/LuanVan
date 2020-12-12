@extends('admin.index')
@section('noidung')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Danh sách các đầu sách</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-lg-7">
                            <h4 class="card-title">TOP CUỐN SÁCH BÁN CHẠY NHẤT TRONG THÁNG</h4>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-2">
                            <select class="form-control" id="sapxepdh" style="width:100%;">
                                <option value="0">Năm </option>
                                <option value="1">Theo ngày đặt</option>
                                <option value="2">Theo tổng tiền</option>
                                <option value="3">Theo trạng thái ĐH</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table dataTable no-footer" role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 137px;">Name</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th1</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th2</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th3</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th4</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th5</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th6</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th7</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th8</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th9</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th10</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th11</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" aria-sort="descending" style="width: 56px;">Th12</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{$doanhthu}}
                                @foreach($doanhthu as $key => $val)
                                {{$val->id_sach}}
                                <tr role="row" class="even">
                                    <td class="">{{$val->ten_sach}}</td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 1)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 2)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 3)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 4)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 5)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 6)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 7)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 8)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 9)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 10)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 11)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                    <td class="sorting_1">
                                        <?php if($val->thang == 12)
                                            echo $val->soluong;
                                            else echo 0
                                        ?>    
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection