<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ujian;
use App\Soal;
use App\Jawaban;
use App\HasilUjian;
use App\Kelas;
use App\MataPelajaran;
use App\User;
use Redirect;
use Auth;

class UjianController extends Controller
{
	public function selesaiujian($id,Request $request){
		$Ujian = Ujian::find($id);
    	$ijin = false;
    	if(!$Ujian)
    		return 1;

		if(Auth::user()){
	    	$HasilUjian = HasilUjian::where("id_ujian",$id)->where("id_user",Auth::id())->first();
	    	if($Ujian->publik != 1 && $HasilUjian)
	    		return 9;
	    }

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Ujian->publik!=1)
    			return 2;
    	}
    	else {
    		if($Ujian->publik != 1){
    			if($Ujian->id_kelas > 0){
			    	if($Ujian->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Ujian->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Ujian->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    }
	    $Soal = Soal::where("id_ujian",$id)->get();
	    $jumlah = 0;
	    $benar = 0;
	    $salah = 0;
	    $kosong = 0;
	    foreach ($Soal as $s) {
	    	if($request->has("jawab".$s->id)){
		    	if(Auth::user()){
		    		$Jawaban = Jawaban::where("id_soal",$s->id)->where("id_user",Auth::id())->first();
		    		if(!$Jawaban)
		    			$Jawaban = new Jawaban();
		    		$Jawaban->jawaban = $request->input("jawab".$s->id);
		    		$Jawaban->id_soal = $s->id;
		    		$Jawaban->id_user = Auth::id();
		    		$Jawaban->save();
		    	}
		    	if($request->input("jawab".$s->id) == $s->jawaban)
		    		$benar+=1;
		    	else $salah+=1;
	    	}
	    	else $kosong+=1;
	    	$jumlah+=1;
	    }
	    if($jumlah == 0)
	    	return Redirect::back()->with('error',"Ujian ini tidak ada soalnya sama sekali");
	    $nilai = round($benar / $jumlah * 100);
	    if(Auth::user()){
	    	$HasilUjian = HasilUjian::where("id_ujian",$id)->where("id_user",Auth::id())->first();
	    	if(!$HasilUjian){
	    		$HasilUjian = new HasilUjian();
	    	}
	    	$HasilUjian->id_user = Auth::id();
	    	$HasilUjian->id_ujian = $id;
	    	$HasilUjian->benar = $benar;
	    	$HasilUjian->salah = $salah;
	    	$HasilUjian->kosong = $kosong;
	    	$HasilUjian->nilai = $nilai;
	    	$HasilUjian->save();
	    }
	    return Redirect::back()->with('success',$nilai);
	}
    public function ujian(){
		$MC = new MediaController();
		$Ujian = Ujian::whereNull('id_kelas')->get();
		$Ujian = [];
		$UjianPublik = Ujian::where("publik",1)->get();
		$UjianKelas = Ujian::where("publik",1)->get();	
		$view = 'ujian';
		$User = User::find(Auth::id());
		if($User){
			if($User->jenis=="user"){
				$Ujian = Ujian::whereNull('id_kelas')->get();
				$UjianKelas = Ujian::where('id_kelas',$User->id_kelas)->get();
			}
			if($User->jenis=="admin"){
				$view = 'admin.ujian';
				$Ujian = Ujian::get();			
			}
			if($User->jenis=="guru"){
				$view = 'admin.ujian';
				$Ujian = Ujian::where("owner",$User->id)->get();			
			}
		}

		foreach ($Ujian as $md) {
			$md->kelas = "Publik";
			if($md->id_kelas>0){
				$kelas = Kelas::find($md->id_kelas);
				if($kelas)
					$md->kelas = $kelas->name;
			}
			else $md->id_kelas=0;
			$md->mata_pelajaran = "-";
			if($md->id_mata_pelajaran>0){
				$mata_pelajaran = MataPelajaran::find($md->id_mata_pelajaran);
				if($mata_pelajaran)
					$md->mata_pelajaran = $mata_pelajaran->name;
			}
			$md->ownername = "-";
			$md->ownerjenis = "-";
			$owner = User::find($md->owner);
			if($owner){
				$md->ownername = $owner->name;
				$md->ownerjenis = $owner->jenis;
			}
		}

		foreach ($UjianKelas as $md) {
			$md->kelas = "Publik";
			if($md->id_kelas>0){
				$kelas = Kelas::find($md->id_kelas);
				if($kelas)
					$md->kelas = $kelas->name;
			}
			else $md->id_kelas=0;
			$md->mata_pelajaran = "-";
			if($md->id_mata_pelajaran>0){
				$mata_pelajaran = MataPelajaran::find($md->id_mata_pelajaran);
				if($mata_pelajaran)
					$md->mata_pelajaran = $mata_pelajaran->name;
			}
			$md->ownername = "-";
			$md->ownerjenis = "-";
			$owner = User::find($md->owner);
			if($owner){
				$md->ownername = $owner->name;
				$md->ownerjenis = $owner->jenis;
			}
		}

		foreach ($UjianPublik as $md) {
			$md->kelas = "Publik";
			if($md->id_kelas>0){
				$kelas = Kelas::find($md->id_kelas);
				if($kelas)
					$md->kelas = $kelas->name;
			}
			else $md->id_kelas=0;
			$md->mata_pelajaran = "-";
			if($md->id_mata_pelajaran>0){
				$mata_pelajaran = MataPelajaran::find($md->id_mata_pelajaran);
				if($mata_pelajaran)
					$md->mata_pelajaran = $mata_pelajaran->name;
			}
			$md->ownername = "-";
			$md->ownerjenis = "-";
			$owner = User::find($md->owner);
			if($owner){
				$md->ownername = $owner->name;
				$md->ownerjenis = $owner->jenis;
			}
		}
		
    	return view($view, ["Kelas" => Kelas::get(),"MataPelajaran" => MataPelajaran::get() ,
    		"Ujian" => $Ujian,
    		"UjianKelas" => $UjianKelas,
    		"UjianPublik" => $UjianPublik,
    	]);
    }

    public function ujiandetail($id){
    	$MediaController = new MediaController();
    	$Ujian = Ujian::find($id);
    	$ijin = false;
    	if(!$Ujian)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Ujian->publik!=1)
    			return 2;
    	}
    	else {
    		if($Ujian->publik != 1){
    			if($Ujian->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Ujian->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Ujian->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	if($Ujian->aktif != 1){
	    		if($User->jenis != "admin" && $User->jenis != "guru")
			    	$ijin = false;
		    	if($User->jenis=="guru" && $User->id != $Ujian->owner)
		    		$ijin = false;
			}
			if($User->jenis=="guru" && $User->id == $Ujian->owner)
		   		$ijin = true;
	    }
    	$md = $Ujian;
    		$md->kelas = "Publik";
			if($md->id_kelas>0){
				$kelas = Kelas::find($md->id_kelas);
				if($kelas)
					$md->kelas = $kelas->name;
			}
			else $md->id_kelas=0;
			$md->mata_pelajaran = "-";
			if($md->id_mata_pelajaran>0){
				$mata_pelajaran = MataPelajaran::find($md->id_mata_pelajaran);
				if($mata_pelajaran)
					$md->mata_pelajaran = $mata_pelajaran->name;
			}
			$md->ownername = "-";
			$md->ownerjenis = "-";
			$owner = User::find($md->owner);
			if($owner){
				$md->ownername = $owner->name;
				$md->ownerjenis = $owner->jenis;
			}
		$Soal = Soal::where("id_ujian",$Ujian->id)->get();
		
		
		if($User){
			$selected = Auth::id();
			if($User->jenis == "admin" || $User->jenis == "guru"){
				if(request()->has("id"))
					$selected = request()->id;
			}
		}
		$HasilUjian = null;
		if(Auth::id()){
			$HasilUjian = HasilUjian::where("id_ujian",$id)->where("id_user",$selected)->first();
			if(!$HasilUjian)
				$HasilUjian = null;
		}

		foreach ($Soal as $s) {
			if($HasilUjian==null)
				$s->jawaban="cari";
			$s->jawabmu="";
			if(Auth::id()){
				$Jawaban = Jawaban::where("id_soal",$s->id)->where("id_user",$selected)->first();
				if($Jawaban)
					$s->jawabmu=$Jawaban->jawaban;
			}
			# code...
		}

		return view('ujiandetail', ["Ujian" => $md,
			"Soal" => $Soal,
			"HasilUjian" => $HasilUjian,
			"ijin" => $ijin,
			"jenis"=>@$MediaController->akunjenis(),
			"MC"=>$MediaController
		]);
    }
    public function bukaujian($id){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $Ujian = Ujian::find($id);
        if(!$Ujian)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }
		$Peserta = User::where("jenis","user")->get();
		if($Ujian->id_kelas>0)
			$Peserta = User::where("jenis","user")
			->where("id_kelas",$Ujian->id_kelas)->get();
		$view = 'admin.ujianbuka';

		foreach ($Peserta as $md) {
			$md->benar=0;
			$md->salah=0;
			$md->kosong=0;
			$md->nilai=0;
			$md->siap=0;

			$HasilUjian = HasilUjian::where("id_ujian",$id)->where("id_user",$md->id)->first();
			if($HasilUjian){
				$md->siap=1;
				$md->benar=$HasilUjian->benar;
				$md->salah=$HasilUjian->salah;
				$md->kosong=$HasilUjian->kosong;
				$md->nilai=$HasilUjian->nilai;
			}
		}
		
    	return view($view, ["Peserta" => $Peserta, "id"=>$id]);
    }
    public function buatujian(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'name' => 'required',
        ]);
        $Ujian = new Ujian();
        $Ujian->name = $request->name;
        $Ujian->deskripsi = $request->deskripsi;
        $Ujian->aktif = $request->aktif;
        $Ujian->publik = $request->publik;
        if($request->id_kelas>0)
        $Ujian->id_kelas = $request->id_kelas;

	    $Ujian->id_mata_pelajaran = $request->id_mata_pelajaran;

	    $Ujian->owner = Auth::id();

        $Ujian->save();
        return Redirect::back()->with('success','Berhasil menambah ujian '.$Ujian->name);
    }
    public function editujian(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $Ujian = Ujian::find($request->id);
        if(!$Ujian)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }
		$Ujian->name = $request->name;
        $Ujian->deskripsi = $request->deskripsi;
        $Ujian->aktif = $request->aktif;
        $Ujian->publik = $request->publik;
        $Ujian->id_kelas = $request->id_kelas;

	    $Ujian->id_mata_pelajaran = $request->id_mata_pelajaran;

	    $Ujian->save();

        return Redirect::back()->with('success','Berhasil edit ujian '.$Ujian->name);
    }

    public function hapusujian(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $Ujian = Ujian::find($request->id);
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }

		$Soal = Soal::where("id_ujian",$Ujian->id)->get();
		foreach ($Soal as $k) {
			@$MC->delete('soal/'.$k->id.'/'.
				$k->file);
			$k->delete();
		}

        $Ujian->delete();

        return Redirect::back()->with('success','Berhasil hapus ujian');
    }
}
