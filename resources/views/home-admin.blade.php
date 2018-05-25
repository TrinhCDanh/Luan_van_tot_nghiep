{{-- <h1>Home page for admin</h1> --}}
@extends('layouts.home')

@section('cssstyle')
	{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
	<div class="content">
 		<div id="app">
			<router-view></router-view>
		</div>
	</div>

	
@endsection

@section('script')
	<script src="{{ asset('js/app.js') }}"></script>
@endsection