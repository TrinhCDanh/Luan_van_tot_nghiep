@extends('layouts.home')

@section('cssstyle')
	<link href="{{ asset('kythuatvien/css/app.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="container">
 		<h3>Đây là trang kythuatvien</h3>
	</div>

	<section id="app">
		<router-view></router-view>
	</section>
@endsection

@section('script')
	<script src="{{ asset('kythuatvien/js/app.js') }}"></script>
@endsection