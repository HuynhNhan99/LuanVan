<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
	<title>Web sách trực tuyến</title>
	<base href="{{asset('')}}">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="theme/images/favicon.png">
	
	<!-- StyleSheet -->
	<link href="theme/css/css/bootstrap.min.css" rel="stylesheet">
    <link href="theme/css/css/price-range.css" rel="stylesheet">
    <link href="theme/css/css/animate.css" rel="stylesheet">
	<link href="theme/css/css/main.css" rel="stylesheet">
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="theme/css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="theme/css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="theme/css/font-awesome.css">
	<!-- Fancybox -->
	<link rel="stylesheet" href="theme/css/jquery.fancybox.min.css">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="theme/css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="theme/css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="theme/css/animate.css">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="theme/css/flex-slider.min.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="theme/css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="theme/css/slicknav.min.css">
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="theme/css/reset.css">
	<link rel="stylesheet" href="theme/style.css">
    <link rel="stylesheet" href="theme/css/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

</head>
<body class="js">
	@include('home.header')
	@yield('noidung')
	@include('home.footer')
	<!-- Jquery -->
    <script src="theme/js/jquery.min.js"></script>
    <script src="theme/js/jquery-migrate-3.0.0.js"></script>
	<script src="theme/js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="theme/js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="theme/js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="theme/js/colors.js"></script>
	<!-- Slicknav JS -->
	<script src="theme/js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="theme/js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="theme/js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="theme/js/waypoints.min.js"></script>
	<!-- Countdown JS -->
	<script src="theme/js/finalcountdown.min.js"></script>
	<!-- Nice Select JS -->
	<script src="theme/js/nicesellect.js"></script>
	<!-- Flex Slider JS -->
	<script src="theme/js/flex-slider.js"></script>
	<!-- ScrollUp JS -->
	<script src="theme/js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="theme/js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="theme/js/easing.js"></script>
	<!-- Active JS -->
	<script src="theme/js/active.js"></script>

	
	
	<script >
	
	jQuery(document).ready(function(){
		$('.addcart').on('click',function(){
			var id =$(this).data('id');
			if(id){
				$.ajax({
					url:"{{ url('add-cart') }}",
					type:"POST",
					data: {
						"_token": '{{ csrf_token() }}',
						"id_sach": $(this).data('id'),
						"soluong": $('#qty').val(),
						}
				}).done(function(response){
					
					$("#change-cart").empty();
					$("#change-cart").html(response);
				})
			}
		});
		
		$('#change-cart').on('click','.remove',function(){
			var rowId =$(this).data('id');
			
			if(rowId){
			$.ajax({
					url:"{{ url('delete-cart/') }}/"+rowId,
					type:"GET",
					
				
				}).done(function(response){
					$("#change-cart").empty();
					$("#change-cart").html(response);
				})}
		});
		$('#list-cart').on('click','.remove',function(){
			var rowId =$(this).data('id');
			
			if(rowId){
			$.ajax({
					url:"{{ url('delete-list-cart/') }}/"+rowId,
					type:"GET",
					
				
				}).done(function(response){
					$("#list-cart").empty();
					$("#list-cart").html(response);
				})}
		});
		$(".all-category").click(function(){
				var main = document.getElementById("main-cate");
				if(main.style.display == "none"){
					$(".main-category").show();
				}else{
					$(".main-category").hide();
				}
		});
		
        
	});
	</script>
</body>
</html>