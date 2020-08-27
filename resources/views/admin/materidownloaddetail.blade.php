@extends("layouts.admin")
@section("content")
  <!-- container -->
 <div class="container">
    <!-- info panel -->
 
  <div class="row justify-content-center">
   <div class="col-10 info-panel">
    <div class="row">
     <a href="{{ url('materi') }}" class="col-lg">
      <img src="{{ url('assets/img/undraw_video_files_fu10.png') }}" alt="Pesawat" class="float-left">
      <h4>Akses Materi</h4>
      <p>Jangkau materi kapan saja dan dimana saja.
      </p>
     </a>
     <a href="{{ url('ujian') }}" class="col-lg">
      <img src="{{ url('assets/img/undraw_fill_forms_yltj.png') }}" alt="Kereta" class="float-left">
      <h4>Akses Latihan</h4>
      <p>Kerjakan latihan materi dimanapun kamu mau.</p>
     </a>
     <a href="{{ url('forum') }}" class="col-lg">
      <img src="{{ url('assets/img/undraw_online_discussion_5wgl.png') }}" alt="Gembok" class="float-left">
      <h4>Terkoneksi dengan forum</h4>
      <p>Jangkau interaksi dengan kelas, teman, dan guru dengan mudah.</p>
     </a>
    </div>
   </div>
  </div>
  <br><br><br>
  <div class="row">
    <div class="col-md-9">
        <div class="card">
          <h5 class="card-header">
            Ujian
          </h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </li>
            <li class="list-group-item">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </li>
            <li class="list-group-item">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </li>
          </ul>
        </div>
        <br>
        <div class="card">
          <h5 class="card-header">
            Forum
          </h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </li>
            <li class="list-group-item">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </li>
            <li class="list-group-item">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </li>
          </ul>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card">
          <h5 class="card-header">
            Tugas
          </h5>
          <ul class="list-group list-group-flush">
            <a href="" class="list-group-item">Cras justo odio
            </a>
            <a href="" class="list-group-item">Cras justo odio
            </a>
            <a href="" class="list-group-item">Cras justo odio
            </a>
          </ul>
        </div>
        <br>
        <div class="card">
          <h5 class="card-header">
            Materi
          </h5>
          <ul class="list-group list-group-flush">
            <a href="" class="list-group-item">Cras justo odio
            </a>
            <a href="" class="list-group-item">Cras justo odio
            </a>
            <a href="" class="list-group-item">Cras justo odio
            </a>
          </ul>
        </div>
    </div>
  </div>
 <!-- end container -->
@endsection