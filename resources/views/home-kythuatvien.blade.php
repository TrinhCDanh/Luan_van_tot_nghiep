@extends('layouts.home')

@section('cssstyle')
	{{-- <link href="{{ asset('kythuatvien/css/app.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
    <?php
        session_start();
        $_SESSION['kythuatvien_id'] = Auth::guard('kythuatvien')->id();
    ?>

    {{ $_SESSION['kythuatvien_id'] }}
    <div class="content">
        <div id="app">
            <router-view></router-view>
        </div>
    </div>
@endsection

@section('script')
	<script src="{{ asset('kythuatvien/js/app.js') }}"></script>
    <script type="text/javascript">
        var kythuatvien_id = <?php echo $_SESSION['kythuatvien_id']; ?>;
        sessionStorage.setItem('kythuatvien_id', kythuatvien_id);
    </script>
@endsection