<!DOCTYPE html>
<html>
<head>
 <title>Learningfy || @yield('title','home')</title>
 <!-- require meta tags -->
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shink-to-fit-no">
  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap/bootstrap.css') }}">

  <!-- my css -->
  <link href="{{ url('assets/custom/style.css?version=2') }}" rel="stylesheet">
<!--   <link href="{{ url('assets/custom/style2.css?version=2') }}" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/frameworks/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/frameworks/alertify/alertify.css') }}">
  <style type="text/css">
    .thumbnail {
      padding:0px;
    }
    .panel {
      position:relative;
    }
    .panel>.panel-heading:after,.panel>.panel-heading:before{
      position:absolute;
      top:11px;left:-16px;
      right:100%;
      width:0;
      height:0;
      display:block;
      content:" ";
      border-color:transparent;
      border-style:solid solid outset;
      pointer-events:none;
    }
    .panel>.panel-heading:after{
      border-width:7px;
      border-right-color:#f7f7f7;
      margin-top:1px;
      margin-left:2px;
    }
    .panel>.panel-heading:before{
      border-right-color:#ddd;
      border-width:8px;
    }
  </style>
</head>
<body>


 <!-- navbar -->

 <nav class="navbar navbar-expand-md navbar-light @hasSection('title') bg-dark @endif">
  <div class="container">
   <a class="navbar-brand" href="{{ url('/') }}">Learningfy</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
    <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="menu">
    <div class="navbar-nav ml-auto">
     <a class="nav-item nav-link" id="menuberanda" href="{{ url('/') }}">Beranda</a>
     <a class="nav-item nav-link" id="menuforum" href="{{ url('forum') }}">Forum</a>
     <a class="nav-item nav-link" id="menuujian" href="{{ url('ujian') }}">Ujian</a>
     <a class="nav-item nav-link" id="menumateri" href="{{ url('materi') }}">Materi</a>
     @if(Auth::id())
     <a class="nav-item nav-link" id="menutugas" href="{{ url('tugas') }}">Tugas</a>
     <a class="nav-item nav-link" id="menuprofil" href="{{ url('user') }}">Profil</a>
     <a class="nav-item nav-link" id="menulogout" href="{{ url('logout') }}">LOG-OUT</a>
     @else
     <a class="nav-item nav-link" id="menulogin" href="{{ url('login') }}">SIGN-IN</a>
     <a class="nav-item nav-link" id="menulogin" href="{{ url('register') }}">SIGN-UP</a>
     @endif
    </div>
   </div>
  </div>
 </nav>

 <!-- end navbar -->

 @hasSection('title')
 <br>
 <br>
 <br>
 @else
 <!-- jumbotron -->
 <div class="jumbotron jumbotron-fluid" style="background-image: url({{ url('assets/img/top-1.jpg?2') }})">
  <div class="container">
   <h1 class="">Ingin E-learning jadi <span>mudah?</span><br> di <span>Learningfy</span> tempatnya</h1>
   @if(Auth::id())
   @else
   <a href="{{ url('login') }}" class="btn btn-primary tombol">SIGN-IN</a>
   @endif
  </div>
 </div>
 <!-- end jumbotron -->
 @endif



 @yield('content')
 <br>
 <!-- optional javascript -->
 <!--jquery, pooper.js, bootstrap.js-->
 <script src="{{ url('assets/jquery/jquery-3.5.1.min.js') }}"></script>
 <script src="{{ url('assets/js/popper.min.js') }}"></script>
 <script src="{{ url('assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('/assets/frameworks/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('/assets/frameworks/alertify/alertify.js') }}"></script>
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
 @yield('script')
</body>
</html>