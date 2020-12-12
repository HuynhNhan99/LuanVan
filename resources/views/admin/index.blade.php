<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin</title>
  <base href="{{asset('')}}">
  <!-- plugins:css -->
  <link rel="stylesheet" href="admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="admin/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="admin/images/favicon.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 
<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
</head>
<body>
  <div class="container-scroller">
    <!-- header admin -->
    @include('admin.header')
    <!-- /header admin-->
    <div class="container-fluid page-body-wrapper">
      <!-- menu admin -->
      @include('admin.menu')
      <!-- /menu admin -->
      <div class="main-panel">

        <!-- noi dung -->
        @yield('noidung')
        <!-- /noi dung -->

        <!-- footer -->
        @include('admin.footer')
        <!-- /footer-->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="admin/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="admin/vendors/chart.js/Chart.min.js"></script>
  <script src="admin/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="admin/js/off-canvas.js"></script>
  <script src="admin/js/hoverable-collapse.js"></script>
  <script src="admin/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="admin/js/dashboard.js"></script>
  <script src="admin/js/data-table.js"></script>
  <script src="admin/js/jquery.dataTables.js"></script>
  <script src="admin/js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
 
  <!-- Custom js for this page-->
  <script src="admin/js/chart.js"></script>
  <!-- End custom js for this page-->
  
  <script>
    jQuery(document).ready(function(){
      $(".phivc").click(function(){
        var thanhpho = $('.thanhpho').val();

      });
      $(".choose").change(function(){
        var action = $(this).attr('id');
        var maid = $(this).val();
        var result = '';
        // alert(action);
        // alert(matp);
        // alert('{{ csrf_token() }}')
        if(action=='thanhpho'){
          result ='quanhuyen';
        }else{
          result = 'xaphuong';
        }
        $.ajax({
					url:"{{ url('select-dc') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"maid": maid,
						"action": action,
						}
				}).done(function(response){
					$("#"+result).html(response);
					
				})
      });
      $('.phi-ship').on('blur',function(){
        var maid = $(this).data('ship_id');
        var phi = $(this).text();
        $.ajax({
					url:"{{ url('update-phivc') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"ma_phi": maid,
						"phi_vc": phi,
						}
				}).done(function(response){
					location.reload();
					
				})
      });
      $(".locdh").change(function(){
        var tt = $(this).val();
        var sx = $('#sapxepdh').val();
        $.ajax({
          url:"{{ url('loc-don-hang') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"tt": tt,
						"sx": sx,
						}
				}).done(function(response){
          $("#loc-dh").empty();
					$("#loc-dh").html(response);
				})
      });
      $(".theloaikm").change(function(){
        var tl = $(this).val();
        $.ajax({
          url:"{{ url('tl-km') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"id_tl": tl,
						}
				}).done(function(response){
          $("#tlkm").empty();
					$("#tlkm").html(response);
				})
      });
      $("#sapxepdh").change(function(){
        var sx = $(this).val();
        var tt = $('.locdh').val();
        $.ajax({
          url:"{{ url('loc-don-hang') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"tt": tt,
						"sx": sx,
						}
				}).done(function(response){
          $("#loc-dh").empty();
					$("#loc-dh").html(response);
				})
      });
      $("#search1").click(function(){
        var tk = $('#timkiem').val();
        $.ajax({
          url:"{{ url('tl-km') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"timkiem": tk,
						}
				}).done(function(response){
          $("#tlkm").empty();
					$("#tlkm").html(response);
				})

      });
      $("#topthang").change(function(){
        var thang = $(this).val();
        $.ajax({
          url:"{{ url('top-10?thang=') }}"+thang+"&nam="+2020,
					type:"GET",
				}).done(function(response){
          $("#topsach").empty();
					$("#topsach").html(response);
				})
      });
    });
   
    
  </script>
</body>

</html>

