@extends('layouts.admin')

@section('title', 'Materi Download')

@section('content_header')
    <h1>Materi Download
    </h1>
@stop

@section('content')

      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <div class="pull-right">
                	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                		<i class="fa fa-plus"></i> Tambah Materi Download
                	</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Owner</th>
                      <th>Kelas</th>
                      <th>Mata Pelajaran</th>
                      <th>Deskripsi</th>
                      <th>File</th>
                      <th>Download</th>
                      <th>Aktif</th>
                      <th style="width: 100px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@php
                  		$i=1;
                  	@endphp
                  	@foreach($MateriDownload as $k)
                    <tr>
                      <td>{{ $i }}.</td>
                      <td><a href="{{ url('materi/'.$k->id) }}" id="nameasli{{ $k->id }}">{{ $k->name }}</a></td>
                      <td>{{ $k->ownername }} ({{ $k->ownerjenis }})</td>
                      <div style="display: none;" id="idkelasasli{{ $k->id }}"
                        >{{ $k->id_kelas }}</div>
                      <td>
                        {{ $k->kelas }}
                      </td>
                      <div style="display: none;" id="idmatapelajaranasli{{ $k->id }}"
                        >{{ $k->id_mata_pelajaran }}</div>
                      <td>
                        {{ $k->mata_pelajaran }}
                      </td>
                      <div style="display: none;" id="deskripsiasli{{ $k->id }}"
                        >{{ $k->deskripsi }}</div>
                      <td>
                        {!! nl2br(e($k->deskripsi)) !!}
                      </td>
                      <td>
                        <a href="{{ url('materidownload/download/'.$k->id.'/'.$k->file.'?download') }}">{{ $k->file }}</a>
                      </td>
                      <td>
                        {!! nl2br(e($k->download)) !!}
                      </td>
                      <div style="display: none;" id="aktifasli{{ $k->id }}"
                        >{{ $k->aktif }}</div>
                      <td>
                        @if($k->aktif==1)
                        Aktif
                        @else
                        Mati
                        @endif
                      </td>
                      <td nowrap style=color:white>
                      	<button class="btn btn-danger" onclick="hapus({{ $k->id }})">
                      		<i class="fa fa-trash"></i> Hapus
                      	</button>
                      	<button class="btn btn-info" onclick="edit({{ $k->id }})">
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
              <h4 class="modal-title">Tambah Materi Download</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=fbuatmateridownload action="{{ url('materidownload/buat') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<div class="col-md-3 text-center">
            				Nama Materi Download
            			</div>
            			<div class="col-md-9">
            				<input type=text class="form-control" name="name" required>
            			</div>
                  <div class="col-md-3 text-center">
                    Deskripsi
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="deskripsi" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    Kelas
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="id_kelas" required>
                      <option value=0>Publik</option>
                      @foreach($Kelas as $kelas)
                      <option value="{{ $kelas->id }}">
                        {{ $kelas->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    Mata Pelajaran
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="id_mata_pelajaran" required>
                      @foreach($MataPelajaran as $mp)
                      <option value="{{ $mp->id }}">
                        {{ $mp->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    File
                  </div>
                  <div class="col-md-9">
                    <input type=file id=ftambahthumb class="form-control" name=file>
                  </div>
                  <div class="col-md-3 text-center">
                    
                  </div>
                  <div class="col-md-9">
                    <input type=checkbox name=aktif value=1>Aktif
                  </div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('fbuatmateridownload').submit()" class="btn btn-primary">
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
              <h4 class="modal-title">Edit Materi Download</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=feditmateridownload action="{{ url('materidownload/edit') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<div class="col-md-3 text-center">
            				Nama Materi Download
            			</div>
            			<div class="col-md-9">
            				<input type=hidden id=feditid name=id value=>
            				<input type=text id=feditname class="form-control" name="name" required>
            			</div>
                  <div class="col-md-3 text-center">
                    Deskripsi
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="deskripsi" required
                    id="feditdeskripsi"></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    Kelas
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="id_kelas" required id="feditidkelas">
                      <option value=0>Publik</option>
                      @foreach($Kelas as $kelas)
                      <option value="{{ $kelas->id }}">
                        {{ $kelas->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    Mata Pelajaran
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="id_mata_pelajaran" required 
                    id="feditidmatapelajaran">
                      @foreach($MataPelajaran as $mp)
                      <option value="{{ $mp->id }}">
                        {{ $mp->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 text-center">
                    File (ganti)
                  </div>
                  <div class="col-md-9">
                    <input type=file class="form-control" name=file>
                  </div>
                  <div class="col-md-3 text-center">
                    
                  </div>
                  <div class="col-md-9">
                    <input type=checkbox id=feditaktif name=aktif value=1>Aktif
                  </div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('feditmateridownload').submit()" class="btn btn-primary">
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
              <h4 class="modal-title">Hapus Materi Download</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=fhapusmateridownload action="{{ url('materidownload/hapus') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<input type=hidden id=fhapusid name=id value=>
            			<div id="fhapus" class="col-md-12 text-center">
            			</div>
            			<div class="col-md-12 text-center">
            				<img id="fhapusgambar" src width="150">
            			</div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('fhapusmateridownload').submit()" class="btn btn-primary">
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
			$('#feditname').val( $('#nameasli' + id).html() );
      $('#feditdeskripsi').val( $('#deskripsiasli' + id).html() );
      $('#feditidkelas').val( $('#idkelasasli' + id).html() );
      $('#feditidmatapelajaran').val( $('#idmatapelajaranasli' + id).html() );
      if($('#aktifasli'+ id).html() == "1"){
        $('#feditaktif').prop('checked',true);
      }
      else{
        $('#feditaktif').prop('checked',false);
      }

		}
		function hapus(id) {
			$('#modal-hapus').modal('show');

			$('#fhapusid').val(id);
			$('#fhapus').html( $('#nameasli' + id).html() );
			document.getElementById('fhapusgambar').src=document.getElementById('gambarasli' + id).src;

		}
		function ftambahgt(input){
	        if (input.files && input.files[0]) {
            	var reader = new FileReader();
		        reader.onload = function (e) {
        		    $('#ftambahgambar').attr('src', e.target.result);
            	}
            
            	reader.readAsDataURL(input.files[0]);
        	}
        }
		function feditgt(input){
	        if (input.files && input.files[0]) {
            	var reader = new FileReader();
		        reader.onload = function (e) {
        		    $('#feditgambar').attr('src', e.target.result);
            	}
            
            	reader.readAsDataURL(input.files[0]);
        	}
        }
	</script>

@endsection