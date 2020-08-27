<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Elearning Admin')</title>
  <link rel="stylesheet" href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendor/adminlte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/frameworks/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/frameworks/alertify/alertify.css') }}">
  <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  @yield('styles')

</head>

<body class="sidebar-mini ">

  <div class="wrapper">
    <nav style="background-color:#25bd69" class="main-header navbar navbar-expand-md navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#">
            <i class="fas fa-bars"></i>
            <span class="sr-only">Toggle navigation</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto ">
        <li class="nav-item">
          <a class="nav-link" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-power-off"></i> Log Out
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-light elevation-4">
      <a href="{{ url('/') }}" class="brand-link ">
        <span class="brand-text font-weight-light ">
          <b>E</b>-Learning
        </span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">
            <li class="nav-header">Menu</li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/user') }}">
                <i class="fas fa-fw fa-user "></i>
                <p>Akun</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/kelas') }}">
                <i class="fas fa-fw fa-list "></i>
                <p>Kelas</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/matapelajaran') }}">
                <i class="fas fa-fw fa-leaf "></i>
                <p>Mata Pelajaran</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/materidownload') }}">
                <i class="fas fa-download"></i>
                <p>Materi Download</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/tugas') }}">
                <i class="fa fa-book"></i>
                <p>Tugas</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/ujian') }}">
                <i class="fa fa-globe"></i>
                <p>Ujian</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="{{ url('/forum') }}">
                <i class="fas fa-users"></i>
                <p>Forum</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper" style="background-image: url({{ url('assets/img/top-1.jpg?2') }})">
      <div class="content-header" style="background-color: white">
        <div class="container-fluid">
          @yield('content_header', '')
        </div>
      </div>
      <br>
      <div class="content">

        @yield('content', '')
      </div>
    </div>

    <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('/assets/frameworks/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('/assets/frameworks/alertify/alertify.js') }}"></script>

    <script type="text/javascript">
      
      var public_path = '{{ url('/') }}';
      var csrf_token = '{{ csrf_token() }}';

    </script>

    @if (\Session::has('success'))
        <script>
          toastr.success("{!! \Session::get('success') !!}");
        </script>
    @endif
    @if (\Session::has('error'))
        <script>
          toastr.error("{!! \Session::get('error') !!}");
        </script>
    @endif

    @yield('scripts')

</body>

</html>