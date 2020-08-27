@extends("layout.biasa")
@section("title")
  {{ $MateriDownload->name }}
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <h5 class="card-header text-white bg-primary">{{ $MateriDownload->name }}</h5>
        <div class="card-body">
          {{ $MateriDownload->deskripsi }}<br>
          {!! $MC->buka2(url('materi/download/'.$MateriDownload->id.'/'.$MateriDownload->file)) !!}
        </div>
        <div class="card-footer">
        @if($MateriDownload->file != null)
          <a href="{{ url('materidownload/download/'.$MateriDownload->id.'/'.$MateriDownload->file.'?download') }}" class="btn btn-primary"><i class="fa fa-download"></i> {{ $MateriDownload->file }}</a>
        @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <h5 class="card-header text-white bg-primary">Rincian</h5>
        <ul class="list-group list-group-flush">
        @if($MateriDownload->download > 0)
        <li class="list-group-item">
          Download : <i class="fa fa-download"></i> 
          {{ $MateriDownload->download }} kali
        </li>
        @endif
        <li class="list-group-item">
        Dibuat : <a href="{{ url('akundetail/'.$MateriDownload->owner) }}">
        {{ $MateriDownload->ownername }}
          </a>
        </li>
        <li class="list-group-item">
        Kelas : {{ $MateriDownload->kelas }} 
        </li>
        <li class="list-group-item">
        Mata Pelajaran : {{ $MateriDownload->mata_pelajaran }} 
        </li>
        <li class="list-group-item">
        Dibuat : {{ $MateriDownload->created_at }} 
        </li>
        <li class="list-group-item">
        Diubah : {{ $MateriDownload->updated_at }} 
        </li>
      </div>
    </div>
  </div>
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>
 <!-- end container -->
@endsection