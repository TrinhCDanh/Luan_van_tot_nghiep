@extends('layouts.home')

@section('cssstyle')
	{{-- <link href="{{ asset('giangvien/css/app.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
	<div class="content">
 		<div id="app">
			<router-view></router-view>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('giangvien/js/app.js') }}"></script>
@endsection