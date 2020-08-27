@extends('layouts.admin')

@section('title', 'Kelas')

@section('content_header')
    <h1>Kelas
    </h1>
@stop

@section('content')

      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <div class="pull-right">
                	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                		<i class="fa fa-plus"></i> Tambah Kelas
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
                      <th style="width: 100px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@php
                  		$i=1;
                  	@endphp
                  	@foreach($Kelas as $k)
                    <tr>
                      <td>{{ $i }}.</td>
                      <td><a id="nameasli{{ $k->id }}">{{ $k->name }}</a></td>
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
              <h4 class="modal-title">Tambah Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=fbuatkelas action="{{ url('kelas/buat') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<div class="col-md-3 text-center">
            				Nama Kelas
            			</div>
            			<div class="col-md-9">
            				<input type=text class="form-control" name="name" required>
            			</div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('fbuatkelas').submit()" class="btn btn-primary">
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
              <h4 class="modal-title">Edit Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=feditkelas action="{{ url('kelas/edit') }}" enctype="multipart/form-data">
            		@csrf
            		<div class="row">
            			<div class="col-md-3 text-center">
            				Nama Kelas
            			</div>
            			<div class="col-md-9">
            				<input type=hidden id=feditid name=id value=>
            				<input type=text id=feditname class="form-control" name="name" required>
            			</div>
            		</div>
	          	</form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
              &times; Batal
          	  </button>
              <button type="button" onclick="document.getElementById('feditkelas').submit()" class="btn btn-primary">
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
              <h4 class="modal-title">Hapus Kelas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<form method="post" id=fhapuskelas action="{{ url('kelas/hapus') }}" enctype="multipart/form-data">
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
              <button type="button" onclick="document.getElementById('fhapuskelas').submit()" class="btn btn-primary">
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
			document.getElementById('feditgambar').src=document.getElementById('gambarasli' + id).src;

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