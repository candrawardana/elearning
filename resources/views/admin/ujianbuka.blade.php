@extends('layouts.admin')

@section('title', 'Peserta')

@section('content_header')
    <h1>Peserta
    	@if($q ?? '' != "")
    	 : <i class="fa fa-search"></i> {{ $q ?? '' }}
    	@endif
    </h1>
@stop

@section('content')

      <div class="container-fluid">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 90px">PP</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Benar</th>
                      <th>Salah</th>
                      <th>Kosong</th>
                      <th>Nilai</th>
                      <th style="width: 100px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@php
                  		$i=1;
                  	@endphp
                  	@foreach($Peserta as $p)
                    <tr>
                      <td>{{ $i }}.</td>
                      <td><img width=90 src="{{ url('user/download/'.$p->id.'?date='.date('YmdHis')) }}"></td>
                      <td><a href="{{ url('userdetail/'.$p->id) }}" id="namaasli{{ $p->id }}">{{ $p->name }}</a></td>
                      <td id="emailasli{{ $p->id }}">{{ $p->email }}</td>
                      <td>{{ $p->benar }}</td>
                      <td>{{ $p->salah }}</td>
                      <td>{{ $p->kosong }}</td>
                      <td>{{ $p->nilai }}</td>
                      <td nowrap style=color:white>
                        @if($p->siap==1)
                      	<a class="btn btn-info" href="{{ url('ujiandetail/'.$id.'?id='.$p->id) }}">
                      		<i class="fa fa-eye"></i> Lihat Jawaban
                      	</a>
                        @endif
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

@endsection