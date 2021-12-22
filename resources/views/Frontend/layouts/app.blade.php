<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>FLY-MARKET  || @yield('title')</title>

{{-- fav icon  --}}
<link rel="shortcut icon" type="image/png" href="{{asset('public/Frontend')}}/assets/images/logo/logo3.png">

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/main.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/blue.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/owl.carousel.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/owl.transitions.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/animate.min.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/rateit.css">
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('public/Frontend')}}/assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@yield('style')
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
    @include('Frontend.partials.header')

<!-- ============================================== HEADER : END ============================================== -->

<!-- /#top-banner-and-menu -->

@yield('content')

<!-- ============================================================= FOOTER ============================================================= -->
@include('Frontend.partials.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{asset('public/Frontend')}}/assets/js/jquery-1.11.1.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/owl.carousel.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/echo.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/jquery.easing-1.3.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap-slider.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="{{asset('public/Frontend')}}/assets/js/lightbox.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('public/Frontend')}}/assets/js/wow.min.js"></script>
<script src="{{asset('public/Frontend')}}/assets/js/scripts.js"></script>
@yield('scripts')


<script type="text/javascript">
    @if ($errors->any())
       @foreach ($errors->all() as $error)
           toastr.error("{!! $error !!}");
       @endforeach
   @endif
</script>


@if (Session::has('success'))
<script type="text/javascript">
   toastr.success("{!! Session::get('success') !!}");
</script>
@endif

</body>
</html>

