<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{ asset('asset/fontend/css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/fontend/css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/fontend/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{asset('asset/fontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('asset/fontend/css/styles.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    @stack('css')
</head>
<body>

@include('layouts.fontend.partial.header')

@yield('content')

@include('layouts.fontend.partial.fotter')

<!-- SCIPTS -->
<script src="{{ asset('asset/fontend/js/jquery-3.1.1.min.js') }}"></script>

<script src="{{ asset('asset/fontend/js/tether.min.js') }}"></script>

<script src="{{ asset('asset/fontend/js/bootstrap.js') }}"></script>
<script src="{{asset('asset/fontend/js/swiper.js')}}"></script>
<script src="{{ asset('asset/fontend/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}','Error',{
        closeButton:true,
        progressBar:true,
    });
    @endforeach
    @endif
</script>
@stack('js')
</body>
</html>