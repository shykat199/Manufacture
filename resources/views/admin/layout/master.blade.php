<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta content="{{ csrf_token() }}" name="csrf_token"/>


    <title>@yield('title')</title>

    <!-- vendor css -->
    <link href="{{asset('admin/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">
{{--    <link href="{{asset('admin/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">--}}
    <link href="{{asset('admin/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/starlight.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('admin.custom.style')
</head>
<body>
@include('sweetalert::alert')

@include('admin.layout.left-side')

@include('admin.layout.header')

<div class="sl-mainpanel">

    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">@yield('page-breadcrumb')</span>
    </nav>

    @yield('admin.content')

{{--    @include('admin.layout.footer')--}}

</div>


<script src="{{asset('admin/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('admin/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('admin/lib/select2/js/select2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin/lib/popper.js/popper.js')}}"></script>
<script src="{{asset('admin/lib/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('admin/lib/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('admin/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('admin/lib/d3/d3.js')}}"></script>
<script src="{{asset('admin/lib/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{asset('admin/lib/chart.js/Chart.js')}}"></script>
<script src="{{asset('admin/lib/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('admin/lib/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('admin/lib/Flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('admin/lib/flot-spline/jquery.flot.spline.js')}}"></script>

<script src="{{asset('admin/js/starlight.js')}}"></script>
<script src="{{asset('admin/js/ResizeSensor.js')}}"></script>
<script src="{{asset('admin/js/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('admin.custom.script')
</body>
</html>
