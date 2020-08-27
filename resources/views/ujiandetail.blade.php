@extends("layout.biasa")
@section("title")
  {{ $Ujian->name }}
@endsection
@section('script')
  <script type="text/javascript">
    function mulaiujian(){
      document.getElementById("belum").style="display:none";
      document.getElementById("sudah").style="";
    }
  </script>
@endsection
@section("content")
  <!-- container -->
 <div class="container">
  <div class="row" id="belum">
    <div class="col-md-9">
      <div class="card">
        <h5 class="card-header text-white bg-primary">{{ $Ujian->name }}</h5>
        <div class="card-body">
          {{ $Ujian->deskripsi }}<br>
        </div>
        @if($HasilUjian != null)
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Benar : {{ $HasilUjian->benar }}</li>
          <li class="list-group-item">Salah : {{ $HasilUjian->salah }}</li>
          <li class="list-group-item">Kosong : {{ $HasilUjian->kosong }}</li>
        </ul>
        @endif

        @if (\Session::has('success') || $HasilUjian != null)
        <div class="card-footer">
            <div class="alert alert-success">
                Nilai : 
                @if($HasilUjian==null)
                {!! \Session::get('success') !!}
                @else
                {{ $HasilUjian->nilai }}
                @endif
            </div>
            </div>
        @endif

        <div class="card-footer">
        @if($Ujian->aktif==1 || $HasilUjian!=null)
        <button onclick="mulaiujian()" class="btn btn-primary"><i class="fa fa-play"></i> 
          Buka Ujian
        </button>
        @endif
        </div>

      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <h5 class="card-header text-white bg-primary">Rincian</h5>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
        Dibuat : <a href="{{ url('akundetail/'.$Ujian->owner) }}">
        {{ $Ujian->ownername }}
          </a>
        </li>
        <li class="list-group-item">
        Kelas : {{ $Ujian->kelas }} 
        </li>
        <li class="list-group-item">
        Mata Pelajaran : {{ $Ujian->mata_pelajaran }} 
        </li>
        <li class="list-group-item">
        Dibuat : {{ $Ujian->created_at }} 
        </li>
        <li class="list-group-item">
        Diubah : {{ $Ujian->updated_at }} 
        </li></ul>
      </div>
    </div>
  </div>

  @if($Ujian->aktif == 1 || $HasilUjian!=null)
  <div class="row" id="sudah" style="display: none">
    <form class="col-md-12" method=post action = "{{ url('ujiandetail/'.$Ujian->id.'/selesai') }}">
      @csrf
      @php
      $i = 0;
      @endphp
      @foreach($Soal as $list)
      @php
      $i++;
      @endphp
      <div class="card">
        <h5 class="card-header text-white bg-primary">Soal no <b id="soalsekarang">{{ $i }}</b>.</h5>
        <div class="card-body" id="soalnya">{{ $list->soal }}<br>
        {!! @$MC->buka2(url('soaldetail/'.$list->id.'/'.$list->file)) !!}</div>
        <div class="card-footer">
        <ul class="list-group list-group-flush">
          <label for="piliha{{ $list->id }}">
            <li class="list-group-item
            @if($list->jawaban=='a')
              @if($list->jawabmu == $list->jawaban)
              bg-success 
              @else
              bg-danger 
              @endif
              text-white
            @endif
            ">
              <div class=row>
                <div class="col-md-1">
                  A <input type=radio id="piliha{{ $list->id }}" name="jawab{{ $list->id }}" value=a
                  @if($list->jawabmu == "a")
                  checked="checked"
                  @endif
                  >
                </div>
                <div class="col-md-11">
                  {{ $list->a }}
                </div>
              </div>
            </li>
          </label>
          <label for="pilihb{{ $list->id }}">
            <li class="list-group-item
            @if($list->jawaban=='b')
              @if($list->jawabmu == $list->jawaban)
              bg-success 
              @else
              bg-danger 
              @endif
              text-white
            @endif
            ">
              <div class=row>
                <div class="col-md-1">
                  B <input type=radio id="pilihb{{ $list->id }}" name="jawab{{ $list->id }}" value=b
                  @if($list->jawabmu == "b")
                  checked="checked"
                  @endif
                  >
                </div>
                <div class="col-md-11">
                  {{ $list->b }}
                </div>
              </div>
            </li>
          </label>
          <label for="pilihc{{ $list->id }}">
            <li class="list-group-item
            @if($list->jawaban=='c')
              @if($list->jawabmu == $list->jawaban)
              bg-success 
              @else
              bg-danger 
              @endif
              text-white
            @endif
            ">
              <div class=row>
                <div class="col-md-1">
                  C <input type=radio id="pilihc{{ $list->id }}" name="jawab{{ $list->id }}" value="c"
                  @if($list->jawabmu == "c")
                  checked="checked"
                  @endif
                  >
                </div>
                <div class="col-md-11">
                  {{ $list->c }}
                </div>
              </div>
            </li>
          </label>
          <label for="pilihd{{ $list->id }}">
            <li class="list-group-item 
            @if($list->jawaban=='d')
              @if($list->jawabmu == $list->jawaban)
              bg-success 
              @else
              bg-danger 
              @endif
             text-white 
            @endif
            ">
              <div class=row>
                <div class="col-md-1">
                  D <input type=radio id="pilihd{{ $list->id }}" name="jawab{{ $list->id }}" value="d"
                  @if($list->jawabmu == "d")
                  checked="checked"
                  @endif
                  >
                </div>
                <div class="col-md-11">
                  {{ $list->d }}
                </div>
              </div>
            </li>
          </label>
        </ul>
        </div>
      </div>
      <br>
      @endforeach
      @if(!(request()->has("id")))
      @if(!($Ujian->publik != 1 && $HasilUjian!=null))
      <p align=center>
      <button type=submit class="btn btn-lg btn-block btn-primary"><i class="fa fa-stop"></i> Selesai Ujian</button>
      </p>
      @endif
      @endif
    </form>
  </div>
  @endif
 
 <!-- end info panel -->
   <!-- footer -->
 <!-- end footer -->
 </div>
 <!-- end container -->
@endsection