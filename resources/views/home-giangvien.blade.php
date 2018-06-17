@extends('layouts.home')

@section('cssstyle')
	{{-- <link href="{{ asset('giangvien/css/app.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')
	<?php
        session_start();
        $_SESSION['giangvien_id'] = Auth::guard('giangvien')->id();
        $_SESSION['roll'] = 'giangvien';
    ?>
	<div class="content">
 		<div id="app">
			<router-view></router-view>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
        var giangvien_id = <?php echo $_SESSION['giangvien_id']; ?>;
        var roll = '<?php echo $_SESSION['roll']; ?>';
        sessionStorage.setItem('giangvien_id', giangvien_id);
        sessionStorage.setItem('roll', roll);
    </script>
	<script src="{{ asset('giangvien/js/app.js') }}"></script>
@endsection