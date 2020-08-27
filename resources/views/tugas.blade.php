@extends("layout.biasa")
@section("title")
  Tugas
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <h5 class="card-header text-white bg-primary">
            Tugas
          </h5>
          <ul class="list-group list-group-flush">
            @foreach($Tugas as $list)
            <li class="list-group-item">
                <h5 class="card-title">{{ $list->name }}</h5>
                <p class="card-text">{{ $list->deskripsi }}</p>
                <a href="{{ url('tugasdetail/'.$list->id) }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Buka</a>
                <small class="pull-right">
                  <i class="fa fa-user"></i> 
                  {{ $list->ownername }} [{{ $list->ownerjenis }}]
                </small>
            </li>
            @endforeach
          </ul>
        </div>
        <br>
    </div>
  </div>
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>
 <!-- end container -->
@endsection