@extends('layouts.admin')

@section('title', 'Soal')

@section('content_header')
    <h1>Soal
    </h1>
@stop

@section('content')

      <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <div class="pull-right">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    <i class="fa fa-plus"></i> Tambah Soal
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Soal</th>
                      <th>File</th>
                      <th>A</th>
                      <th>B</th>
                      <th>C</th>
                      <th>D</th>
                      <th>Jawaban</th>
                      <th style="width: 100px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=1;
                    @endphp
                    @foreach($Soal as $k)
                    <tr>
                      <td>{{ $i }}.</td>
                      <div style="display: none;" id="soalasli{{ $k->id }}"
                        >{{ $k->soal }}</div>
                      <td>
                        {!! nl2br(e($k->soal)) !!}
                      </td>
                      <td>
                        <a href="{{ url('soaldetail/'.$k->id.'/'.$k->file.'?download') }}">{{ $k->file }}</a>
                      </td>
                      <td id="aasli{{ $k->id }}"
                        >{{ $k->a }}</td>
                      <td id="basli{{ $k->id }}"
                        >{{ $k->b }}</td>
                      <td id="casli{{ $k->id }}"
                        >{{ $k->c }}</td>
                      <td id="dasli{{ $k->id }}"
                        >{{ $k->d }}</td>
                      <td id="jawabanasli{{ $k->id }}"
                        >{{ $k->jawaban }}</td>
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
              <h4 class="modal-title">Tambah Soal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fbuatujian action="{{ url('soal/'.$id.'/buat') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-3 text-center">
                    Soal
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="soal" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    A
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="a" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    B
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="b" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    C
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="c" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    D
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" name="d" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    Jawaban
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" name="jawaban">
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                    </select>
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
              <button type="button" onclick="document.getElementById('fbuatujian').submit()" class="btn btn-primary">
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
              <h4 class="modal-title">Edit Soal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=feditujian action="{{ url('soal/'.$id.'/edit') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-3 text-center">
                    Soal
                  </div>
                  <div class="col-md-9">
                    <input type=hidden id=feditid name=id value=>
                    <textarea class="form-control" id=feditsoal name="soal" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    A
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" id=fedita name="a" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    B
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" id=feditb name="b" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    C
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" id=feditc name="c" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    D
                  </div>
                  <div class="col-md-9">
                    <textarea class="form-control" id=feditd name="d" required></textarea>
                  </div>
                  <div class="col-md-3 text-center">
                    Jawaban
                  </div>
                  <div class="col-md-9">
                    <select id=feditjawaban class="form-control" name="jawaban">
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                    </select>
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
              <button type="button" onclick="document.getElementById('feditujian').submit()" class="btn btn-primary">
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
              <h4 class="modal-title">Hapus Soal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id=fhapusujian action="{{ url('soal/'.$id.'/hapus') }}" enctype="multipart/form-data">
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
              <button type="button" onclick="document.getElementById('fhapusujian').submit()" class="btn btn-primary">
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
      $('#feditsoal').val( $('#soalasli' + id).html() );

      $('#fedita').val( $('#basli' + id).html() );
      $('#feditb').val( $('#aasli' + id).html() );
      $('#feditc').val( $('#casli' + id).html() );
      $('#feditd').val( $('#dasli' + id).html() );

      $('#feditjawaban').val( $('#jawabanasli' + id).html() );
    }
    function hapus(id) {
      $('#modal-hapus').modal('show');

      $('#fhapusid').val(id);
      $('#fhapus').html( $('#soalasli' + id).html() );
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