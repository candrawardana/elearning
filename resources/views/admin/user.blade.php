@extends('layouts.admin')

@section('title', 'Pengguna')

@section('content_header')
    <h1>Pengguna
    	@if($q ?? '' != "")
    	 : <i class="fa fa-search"></i> {{ $q ?? '' }}
    	@endif
    </h1>
@stop

@section('content')

      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <div class="pull-right">
                	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                		<i class="fa fa-plus"></i> Tambah Pengguna
                	</button>
                	@if($q ?? '' != "")
                	<a href="{{ url('user') }}" class="btn btn-info">
                		<i class="fa fa-arrow-left"></i> Semua Pengguna
                	</a>
                	@endif
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 90px">PP</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Kelas</th>
                      <th>Jenis</th>
                      <th style="width: 100px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@php
                  		$i=1;
                  	@endphp
                  	@foreach($Pengguna as $p)
                    <tr>
                      <td>{{ $i }}.</td>
                      <td><img width=90 src="{{ url('user/download/'.$p->id.'?date='.date('YmdHis')) }}"></td>
                      <td><a href="{{ url('userdetail/'.$p->id) }}" id="namaasli{{ $p->id }}">{{ $p->name }}</a></td>
                      <td id="emailasli{{ $p->id }}">{{ $p->email }}</td>
                      <div id="kelasasli{{ $p->id }}" style="display:none">{{ $p->id_kelas }}</div> 
                      <td >{{ $p->kelas }}</td>
                      <td id="jenisasli{{ $p->id }}">{{ $p->jenis }}</td>
                      <td nowrap style=color:white>
                      	<button class="btn btn-danger" onclick="hapus({{ $p->id }})">
                      		<i class="fa fa-trash"></i> Hapus
                      	</button>
                      	<button class="btn btn-info" onclick="edit({{ $p->id }})">
                      		<i class="fa fa-edit"></i> Edit
                      	</button>
                      </td>
                    </tr>
                    @php
                  		$i++;
                  	@endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->


      <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=fbuatpengguna action="{{ url('user/buat') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<div class="col-md-3 text-center">
            				Nama
            			</div>
            			<div class="col-md-9">
            				<input type=text class="form-control" name="name" required>
            			</div>
                  <div class="col-md-3 text-center">
                    Email
                  </div>
                  <div class="col-md-9">
                    <input type=email class="form-control" name="email" required>
                  </div>
                  <div class="col-md-3 text-center">
                    Password
                  </div>
                  <div class="col-md-9">
                    <input type=password class="form-control" name="password" required>
                  </div>
                  <div class="col-md-3 text-center">
                    Jenis
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="jenis" required>
                      <option value="admin">Administrator</option>
                      <option value="guru">Pengajar</option>
                      <option value="user">Pengguna</option>
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    Kelas
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="kelas" required>
                      @foreach($Kelas as $kelas)
                      <option value="{{ $kelas->id }}">
                        {{ $kelas->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('fbuatpengguna').submit()" class="btn btn-primary">
              	<i class="fa fa-plus"></i> Buat
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=feditpengguna action="{{ url('user/edit') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<div class="col-md-3 text-center">
            				Nama
            			</div>
            			<div class="col-md-9">
            				<input type=hidden id=feditid name=id value=>
            				<input type=text id=feditnama class="form-control" name="name" required>
            			</div>
                  <div class="col-md-3 text-center">
                    Email
                  </div>
                  <div class="col-md-9">
                    <input type=email id=feditemail class="form-control" name="email" required>
                  </div>
                  <div class="col-md-3 text-center">
                    Password
                  </div>
                  <div class="col-md-9">
                    <input type=password class="form-control" name="password" required>
                  </div>
                  <div class="col-md-3 text-center">
                    Jenis
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" id=feditjenis name="jenis" required>
                      <option value="admin">Administrator</option>
                      <option value="guru">Pengajar</option>
                      <option value="user">Pengguna</option>
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    Kelas
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="kelas" required id=feditkelas>
                      @foreach($Kelas as $kelas)
                      <option value="{{ $kelas->id }}">
                        {{ $kelas->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('feditpengguna').submit()" class="btn btn-primary">
              	<i class="fa fa-edit"></i> Edit
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=fhapuspengguna action="{{ url('user/hapus') }}" enctype="multipart/form-data">
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

	<script type="text/javascript">
		function edit(id) {
			$('#modal-edit').modal('show');

			$('#feditid').val(id);
			$('#feditnama').val( $('#namaasli' + id).html() );
      $('#feditemail').val( $('#emailasli' + id).html() );
      $('#feditjenis').val( $('#jenisasli' + id).html() );
      $('#feditkelas').val( $('#kelasasli' + id).html() );
		}

		function hapus(id) {
			$('#modal-hapus').modal('show');

			$('#fhapusid').val(id);
			$('#fhapus').html( $('#namaasli' + id).html() );
		}
	</script>

@endsection