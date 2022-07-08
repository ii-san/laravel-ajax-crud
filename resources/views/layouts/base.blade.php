<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset ('js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset ('js/jquery-3.6.0.min.js') }}"></script>
    
    <!-- DataTables -->
    <link href="{{ asset ('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <script src="{{ asset ('js/jquery.dataTables.min.js') }}"></script>

    <title>Ajax CRUD</title>
  </head>
  <body>
    <div class="container">
        @yield('content')
    </div>
  </body>
</html>
