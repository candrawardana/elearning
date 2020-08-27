@extends("layout.biasa")
@section("title")
  {{ $Forum->name }}
@endsection
@section("script")
<script type="text/javascript">
    function tambah() {
      $('#modal-tambah').modal('show');

      $('#fid').val(0);
      $('#fdeskripsi').val( "" );
      $('#fidreply').val(0);
      $('#freply').html("");
    }
    function balas(id) {
      $('#modal-tambah').modal('show');

      $('#fid').val(0);
      $('#fdeskripsi').val( "" );
      $('#fidreply').val($('#idasli' + id).html());
      $('#freply').html($('#deskripsiasli' + id).html());
    }
    function edit(id) {
      $('#modal-tambah').modal('show');

      $('#fid').val($('#idasli' + id).html());
      $('#fdeskripsi').val( $('#deskripsiasli' + id).html() );
      $('#fidreply').val($('#idreplyasli' + id).html());
      $('#freply').html($('#replyasli' + id).html());
    }
    function hapus(id) {
      $('#modal-hapus').modal('show');

      $('#fhapusid').val(id);
      $('#fhapus').html( $('#deskripsiasli' + id).html() );
    }
  </script>
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <h5 class="card-header text-white bg-primary">{{ $Forum->name }}</h5>
        <div class="card-body">
          {{ $Forum->deskripsi }}<br>
          {!! $MC->buka2(url('forum/download/'.$Forum->id.'/'.$Forum->file)) !!}
        </div>
        <div class="card-footer">
        @if($Forum->file != null)
          <a href="{{ url('forum/download/'.$Forum->id.'/'.$Forum->file.'?download') }}" class="btn btn-primary"><i class="fa fa-download"></i> {{ $Forum->file }}</a>
        @endif
        @if($ijin)
          <button class="btn btn-info" onclick="tambah()"><i class="fa fa-reply"></i> Balas</a>
        @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <h5 class="card-header text-white bg-primary">Rincian</h5>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
        Dibuat : <a href="{{ url('akundetail/'.$Forum->owner) }}">
        {{ $Forum->ownername }}
          </a>
        </li>
        <li class="list-group-item">
        Kelas : {{ $Forum->kelas }} 
        </li>
        <li class="list-group-item">
        Mata Pelajaran : {{ $Forum->mata_pelajaran }} 
        </li>
        <li class="list-group-item">
          Dibuat : {{ $Forum->created_at }}
        </li>
        <li class="list-group-item">
          Diubah : {{ $Forum->updated_at }}
        </li>
        <li class="list-group-item">
        Status : 
        @if($Forum->aktif==1)
        Di buka
        @else
        di tutup
        @endif
        </li>
        <li class="list-group-item">
        Publik : 
        @if($Forum->publik)
        Ya
        @else
        Tidak
        @endif
        </li>
        </ul>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    @foreach($ForumIsi as $list)
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-2">
              <img src="{{ url('user/download/'.$list->id_user.'?date='.date('YmdHis')) }}" class="img img-rounded img-fluid"/>
              <p class="text-secondary text-center">{{ $list->created_at }}<br><b>{{ $list->ownerkelas }}</b><br><i>
              {{ $list->ownerjenis }}</i></p>
              
            </div>
            <div class="col-md-10">
              <p>
                <a href="{{ url('userdetail/'.$list->id_user) }}"><strong>{{ $list->ownername }}</strong></a>
              </p>
              <div style="display:none">
                <div id="idreplyasli{{ $list->id }}">{{ $list->id_reply }}</div>
                <div id="replyasli{{ $list->id }}">{{ $list->reply }}</div>
                <div id="idasli{{ $list->id }}">{{ $list->id }}</div>
              </div>
              @if($list->reply!=null)
              <div class="border">
                <div class="card-body">
                  <p>
                    <a href="{{ url('userdetail/'.$list->replyuserid) }}"><strong>{{ $list->replyusername }}</strong></a>
                  </p>
                  <p>{{ $list->reply }}</p>
                </div>
              </div>
              @endif
              <div class="clearfix"></div>
                <p id="deskripsiasli{{ $list->id }}">{{ $list->deskripsi }}</p>
                {!! @$MC->buka2(url('forumisi/download/'.$list->id.'/'.$list->file)) !!}
            </div>
          </div>
          <div>
            @if($ijin)
            <button class="float-right btn btn-outline-primary ml-2" onclick="balas('{{ $list->id }}')"> <i class="fa fa-reply"></i> Balas</button>
            <a href="{{ url('forumisi/downvote/'.$list->id) }}" 
            class="float-right btn ml-2
            @if($list->uservote==0)
            btn-danger
            @else
            btn-outline-danger
            @endif
            "
            >
              <i class="fa fa-thumbs-down"></i> Tidak Suka {{ $list->downvote }}</a>
            <a href="{{ url('forumisi/upvote/'.$list->id) }}" 
            class="float-right btn btn-primary ml-2
            @if($list->uservote==1)
            btn-primary
            @else
            btn-outline-primary
            @endif
            ">
              <i class="fa fa-thumbs-up"></i> Suka {{ $list->upvote }}</a>
            @if($list->id_user==Auth::id())
            <button class="float-right btn btn-info ml-2" onclick="edit('{{ $list->id }}')"> <i class="fa fa-edit"></i> Edit</button>
            @endif
            @if($list->id_user==Auth::id() || $jenis == "admin" || $jenis == "guru")
            <button class="float-right btn btn-danger ml-2" onclick="hapus('{{ $list->id }}')"> <i class="fa fa-trash"></i> Hapus</button>
            @endif
            @endif
            @if($list->file != null)
              <a href="{{ url('forumisi/download/'.$list->id.'/'.$list->file.'?download') }}" class="btn btn-primary"><i class="fa fa-download"></i> {{ $list->file }}</a>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>

      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Kirim Di Forum</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fbuatforum action="{{ url('forumdetail/'.$Forum->id.'/isi') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12 text-center">
                    <div id="freply" class="border">
                    </div>
                  </div>
                  <div class="col-md-3 text-center">
                    Deskripsi
                  </div>
                  <div class="col-md-9">
                    <input type="hidden" name="id" val=0 id=fid>
                    <input type="hidden" name="id_reply" val=0 id=fidreply>
                    <textarea class="form-control" id="fdeskripsi" name="deskripsi" required></textarea>
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
              <button type="button" onclick="document.getElementById('fbuatforum').submit()" class="btn btn-primary">
                <i class="fa fa-plus"></i> Buat
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 <!-- end container -->

 <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Isi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fhapuspengguna action="{{ url('forumdetail/'.$Forum->id.'/hapus') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <input type=hidden id=fhapusid name=id value=>
                  <div id="fhapus" class="col-md-12 text-center">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
              </button>
              <button type="button" onclick="document.getElementById('fhapuspengguna').submit()" class="btn btn-primary">
                <i class="fa fa-trash"></i> Hapus
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection