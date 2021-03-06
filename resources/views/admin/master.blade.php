<!DOCTYPE html>
<html>
<head>
	@section('CssLibraries')@show
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{url('libraries/semanticui/semantic.min.css')}}">
	<link rel="stylesheet" href="{{url('public/css/libraries-ui.min.css')}}">
	<link rel="stylesheet" href="{{url('public/css/all.min.css')}}">
	{{-- sweetalert --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css" id="theme-styles">

	{{-- // --}}
	{{-- //////////////////////// --}}

	<script src="{{url('public/js/libraries-ui.min.js')}}"></script>
	<script src="{{url('public/js/all.min.js')}}"></script>
	{{-- sweetalert --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
	{{-- // --}}
	<title>@yield('title')</title>
</head>
<body class="m4-cloak h-vh-100">

	<main class="navview"  data-toggle="#paneToggle" data-expanded="xl" data-compact="lg" data-active-state="true">
        {{-- @include('admin.sidebar') --}}
		@include('admin.header')
		<section class="content_wrapper bg-light">
			<aside class="container">
				@section('PageContent')@show
			</aside>
		</section>
    </main>
</body>
@section('JsLibraries')@show
</html>
