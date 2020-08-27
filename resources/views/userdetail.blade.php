@extends("layout.biasa")
@section("title")
  {{ $User->name }}
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row">
    <div class="col-md-12 d-flex justify-content-center text-center">
      <div class="card">
        <h5 class="card-header text-white bg-primary">{{ $User->name }}</h5>
        <div class="card-body">
          <img src=" {{ url('user/download/'.$User->id.'?date='.date('YmdHis')) }} " width=300><br>
          Nama : {{ $User->name }}<br>
          Email : {{ $User->email }}<br>
          Jenis : {{ $User->jenis }}<br>
          Kelas : {{ $User->kelas }}<br>
        </div>
        @if(Auth::id()==$User->id)
        <div class="card-footer">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-edit"></i> 
              Ubah Profil
              </button>
          <button data-toggle="modal" data-target="#modal-password" type="button" class="btn btn-primary">
                <i class="fa fa-lock"></i> Ubah Password
          </button>
        </div>
        @endif
      </div>
    </div>
  </div>
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>
 <!-- end container -->


      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fbuattugas action="{{ url('user/update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-3 text-center">
                    Nama
                  </div>
                  <div class="col-md-9">
                    <input class="form-control" name="name" required value="{{ $User->name }}">
                  </div>
                  <div class="col-md-3 text-center">
                    Foto Profil
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

      <div class="modal fade" id="modal-password">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fpassword action="{{ url('user/password') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-3 text-center">
                    Password Baru
                  </div>
                  <div class="col-md-9">
                    <input class="form-control" type="password" name="password" required>
                  </div>
                  <div class="col-md-3 text-center">
                    Ulangi Password Baru
                  </div>
                  <div class="col-md-9">
                    <input class="form-control" type="password" name="baru" required>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
              </button>
              <button type="button" onclick="document.getElementById('fpassword').submit()" class="btn btn-primary">
                <i class="fa fa-plus"></i> Buat
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

@endsection