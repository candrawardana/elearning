@extends("layout.biasa")
@section("title")
  {{ $Tugas->name }}
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <h5 class="card-header text-white bg-primary">{{ $Tugas->name }}</h5>
        <div class="card-body">
          {{ $Tugas->deskripsi }}<br>
          {!! $MC->buka2(url('tugas/download/'.$Tugas->id.'/'.$Tugas->file)) !!}
        </div>
        <div class="card-footer">
        @if($Tugas->file != null)
          <a href="{{ url('tugas/download/'.$Tugas->id.'/'.$Tugas->file.'?download') }}" class="btn btn-primary"><i class="fa fa-download"></i> {{ $Tugas->file }}</a>
        @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <h5 class="card-header text-white bg-primary">Rincian</h5>
        <ul class="list-group list-group-flush">
        @if($Tugas->download > 0)
        <li class="list-group-item">
          Download : <i class="fa fa-download"></i> 
          {{ $Tugas->download }} kali
        </li>
        @endif
        <li class="list-group-item">
        Dibuat : <a href="{{ url('akundetail/'.$Tugas->owner) }}">
        {{ $Tugas->ownername }}
          </a>
        </li>
        <li class="list-group-item">
        Kelas : {{ $Tugas->kelas }} 
        </li>
        <li class="list-group-item">
        Mata Pelajaran : {{ $Tugas->mata_pelajaran }} 
        </li>
        <li class="list-group-item">
        Status : 
        @if($Tugas->aktif)
        Di buka
        @else
        di tutup
        @endif
        </li>
        </ul>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-info">
          <h5>
            Daftar Murid
          </h5>
          </div>
          <ul class="list-group list-group-flush">
            @foreach($User as $list)
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-2">
                  <img src="{{ url('user/download/'.$list->id) }}" width="100%">
                </div>
                <div class="col-md-8">
                  <h5 class="card-title"><a href="{{ url('akundetail/'.$list->id) }}">{{ $list->name }}</a></h5>
                  @if($list->id_kumpul_tugas == null)
                  <font class="text-danger">Belum Terkumpul</font>
                  @else
                  <font class="text-success">Terkumpul</font>
                  @endif
                  @if($jenis=="admin" || $jenis=="guru" || $list->id == Auth::id())
                  <p class="card-text">{{ $list->deskripsi }}</p><br>
                  {!! $MC->buka2(url('kumpultugas/download/'.$list->id_kumpul_tugas.'/'.$list->file)) !!}
                </div>
                <div class="col-md-2">
                  @if($list->file!=null)
                  <a href="{{ url('kumpultugas/download/'.$list->id_kumpul_tugas.'/'.$list->file.'?download') }}" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Download</a>
                  @endif
                  @endif
                </div>
            </li>
            @endforeach
          </ul>
          <div class="card-footer">
            @if($jenis=="user" && $Tugas->aktif==1)
            <button class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
              <i class="fa fa-upload"></i> Kumpul Tugas
            </button>
            @endif
          </div>
        </div>
        <br>
    </div>
  </div>
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>

      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Kumpul Tugas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fbuattugas action="{{ url('tugasdetail/'.$Tugas->id.'/kumpul') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-3 text-center">
                    Deskripsi
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="deskripsi" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    File
                  </div>
                  <div class="col-md-9">
                    <input type=file id=ftambahthumb class="form-control" name=file>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
              </button>
              <button type="button" onclick="document.getElementById('fbuattugas').submit()" class="btn btn-primary">
                <i class="fa fa-plus"></i> Buat
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!-- end container -->
@endsection