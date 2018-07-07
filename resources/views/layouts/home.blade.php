<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>Luận văn tốt nghiệp</title>{{-- {{ config('app.name', 'Laravel') }} --}}
 <!-- Styles -->
{{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
 <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
 <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/vuetify/1.0.19/vuetify.min.css" rel="stylesheet">
 @yield('cssstyle')

</head>
<body>

@yield('content')
{{-- <div class="container">
 <h3>Vue.js CRUD With Laravel 5.5 application</h3>
</div>

<section id="app"></section> --}}

<script>
 window.Laravel = <?php echo json_encode([
 'csrfToken' => csrf_token(),
 ]); ?>
</script>
	
{{--  <script src="{{ asset('js/app.js') }}"></script> --}}
 @yield('script')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}
 <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/vuetify/1.0.19/vuetify.min.js"></script>
 <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.0.0/masonry.pkgd.min.js"></script>
</body>
</html>