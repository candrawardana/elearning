@extends('layouts.admin')

@section('title', 'Pengguna')

@section('content_header')
    <h1>Selamat Datang di panel admin
    	@if($q ?? '' != "")
    	 : <i class="fa fa-search"></i> {{ $q ?? '' }}
    	@endif
    </h1>
@stop

@section('content')

@endsection