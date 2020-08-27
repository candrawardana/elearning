@extends("layout.biasa")
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
 
 <!-- end info panel -->
 

 <!-- deskripsi -->
 
  <div class="row deskripsi">
   <div class="row">
    <div class="col-lg">
     <img src="{{ url('assets/img/undraw_teaching_f1cm.png') }}" class="img-fluid">
    </div>
    <div class="col-lg">
     <h3><span>Kemudahan</span> belajar dengan <span>E-learning</span></h3>
     <p>Proses belajar mengajar dalam e-learning bisa dilakukan oleh siapapun, dimana pun, dan kapanpun.</p>
     <a href="{{ url('materi') }}" class="btn btn-primary tombol">Buka Materi</a>
     <hr>
    </div>
   </div>
   <div class="m-5">
   </div>
   <div class="row">
    <div class="col-lg">
     <h3>mengakses <span>materi</span> pilihan di <span>Learningfy</span></h3>
     <p>Dapatkan berbagai materi berupa artikel, dokumen, dan video yang bahkan bisa diunduh. megerjakan tugas, latihan, dan ikuti diskusi forum.</p>
     <a href="{{ url('forum') }}" class="btn btn-primary tombol">Forum</a>
    </div>
    <div class="col-lg">
     <img src="{{ url('assets/img/undraw_online_learning_ao11.png') }}" class="img-fluid">
     <hr>
    </div>
   </div>
   <div class="m-5">
   </div>
  </div>
 
 <!-- end deskripsi -->
  <!-- footer -->
  <div class="row footer">
   <div class="col text-center text-capitalize">
    <p>&copy;{{ date("Y") }} all rights reserved. </p>
   </div>
  </div>
 <!-- end footer -->
 </div>
 <!-- end container -->
@endsection