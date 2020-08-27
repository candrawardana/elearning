@extends("layout.biasa")
@section("title")
  Ujian
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row">
    @if(Auth::user())
    <div class="col-md-4">
        <div class="card">
          <h5 class="card-header text-white bg-primary">
            Ujian Kelas
          </h5>
          <ul class="list-group list-group-flush">
            @foreach($UjianKelas as $list)
            <li class="list-group-item">
                <h5 class="card-title">{{ $list->name }}</h5>
                <p class="card-text">{{ $list->deskripsi }}</p>
                <a href="{{ url('ujiandetail/'.$list->id) }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Buka</a>
                <small class="pull-right">
                  @if($list->download > 0)
                  <i class="fa fa-download"></i> 
                  {{ $list->download }}
                  @endif
                  <i class="fa fa-user"></i> 
                  {{ $list->ownername }} [{{ $list->ownerjenis }}]
                </small>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <h5 class="card-header text-white bg-primary">
            Ujian Umum
          </h5>
          <ul class="list-group list-group-flush">
            @foreach($Ujian as $list)
            <li class="list-group-item">
                <h5 class="card-title">{{ $list->name }}</h5>
                <p class="card-text">{{ $list->deskripsi }}</p>
                <a href="{{ url('ujiandetail/'.$list->id) }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Buka</a>
                <small class="pull-right">
                  @if($list->download > 0)
                  <i class="fa fa-download"></i> 
                  {{ $list->download }}
                  @endif
                  <i class="fa fa-user"></i> 
                  {{ $list->ownername }} [{{ $list->ownerjenis }}]
                </small>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <h5 class="card-header text-white bg-primary">
            Ujian Publik
          </h5>
          <ul class="list-group list-group-flush">
            @foreach($UjianPublik as $list)
            <li class="list-group-item">
                <h5 class="card-title">{{ $list->name }}</h5>
                <p class="card-text">{{ $list->deskripsi }}</p>
                <a href="{{ url('ujiandetail/'.$list->id) }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Buka</a>
                <small class="pull-right">
                  @if($list->download > 0)
                  <i class="fa fa-download"></i> 
                  {{ $list->download }}
                  @endif
                  <i class="fa fa-user"></i> 
                  {{ $list->ownername }} [{{ $list->ownerjenis }}]
                </small>
            </li>
            @endforeach
          </ul>
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="card">
          <h5 class="card-header text-white bg-primary">
            Ujian Publik
          </h5>
          <ul class="list-group list-group-flush">
            @foreach($UjianPublik as $list)
            <li class="list-group-item">
                <h5 class="card-title">{{ $list->name }}</h5>
                <p class="card-text">{{ $list->deskripsi }}</p>
                <a href="{{ url('ujiandetail/'.$list->id) }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Buka</a>
                <small class="pull-right">
                  @if($list->download > 0)
                  <i class="fa fa-download"></i> 
                  {{ $list->download }}
                  @endif
                  <i class="fa fa-user"></i> 
                  {{ $list->ownername }} [{{ $list->ownerjenis }}]
                </small>
            </li>
            @endforeach
          </ul>
        </div>
    </div>
    @endif
  </div>
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>
 <!-- end container -->
@endsection