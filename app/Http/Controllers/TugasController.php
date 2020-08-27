<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tugas;
use App\MataPelajaran;
use App\Kelas;
use App\User;
use Auth;
use Redirect;
use App\KumpulTugas;

class TugasController extends Controller
{
    //
    public function buka($id,$file){
    	$MediaController = new MediaController();
    	$Tugas = Tugas::find($id);
    	if(!$Tugas)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User)
	    	return 2;
    	if($Tugas->id_kelas > 0){	    	
	    	if($User->jenis == "admin"){
	    	}
	    	else if($User->jenis == "guru"){
	    		if($User->id != $Tugas->owner)
	    			return 3;
	    	}
	    	else{
	    		if($User->id_kelas != $Tugas->id_kelas)
	    			return 4;
	    	}
    	}
    	return @$MediaController->buka('tugas/'.$id.'/'.$file);
    }

    public function kumpulbuka($id,$file){
    	$MediaController = new MediaController();
    	$KumpulTugas = KumpulTugas::find($id);
    	if(!$KumpulTugas)
    		return 0;
    	$Tugas = Tugas::find($KumpulTugas->id_tugas);
    	if(!$Tugas)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User)
	    	return 2;
	    if($User->jenis == "admin"){
	   	}
	   	else if($User->jenis == "guru"){
	   		if($User->id != $Tugas->owner)
	    		return 3;
	   	}
	   	else{
	   		if($User->id != $KumpulTugas->id_user)
	   			return 4;
	   	}
    	return @$MediaController->buka('kumpultugas/'.$id.'/'.$file);
    }

    public function tugas(){
		$MC = new MediaController();
		$Tugas = [];
		$view = 'tugas';
		$User = User::find(Auth::id());
		if($User){
			if($User->jenis=="user"){
				$Tugas = Tugas::where('id_kelas',$User->id_kelas)->orWhereNull('id_kelas')->get();
			}
			if($User->jenis=="admin"){
				$view = 'admin.tugas';
				$Tugas = Tugas::get();			
			}
			if($User->jenis=="guru"){
				$view = 'admin.tugas';
				$Tugas = Tugas::where("owner",$User->id)->get();			
			}
		}
		else return redirect('/');

		foreach ($Tugas as $md) {
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
		
    	return view($view, ["Kelas" => Kelas::get(),"MataPelajaran" => MataPelajaran::get() ,"Tugas" => $Tugas]);
    }

    public function tugasdetail($id){
    	$MediaController = new MediaController();
    	$Tugas = Tugas::find($id);
    	if(!$Tugas)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User)
	    	return 2;
    	if($Tugas->id_kelas > 0){
	    	if($User->jenis == "admin"){
	    	}
	    	else if($User->jenis == "guru"){
	    		if($User->id != $Tugas->owner)
	    			return 3;
	    	}
	    	else{
	    		if($User->id_kelas != $Tugas->id_kelas)
	    			return 4;
	    	}
    	}
    	$md = $Tugas;
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
		$User = User::where("id_kelas",$md->id_kelas)->where("jenis","user")->get();
		foreach ($User as $u) {
			$KumpulTugas = KumpulTugas::where("id_tugas",$md->id)->where("id_user",$u->id)->first();
			$u->id_kumpul_tugas = null;
			$u->deskripsi = null;
			$u->file = null;
			if($KumpulTugas){
				$u->id_kumpul_tugas = $KumpulTugas->id;
				$u->deskripsi = $KumpulTugas->deskripsi;
				$u->file = $KumpulTugas->file;
			}
		}
		return view('tugasdetail', ["Tugas" => $md,
			"User" => $User ,"MC" => $MediaController , "jenis"=>@$MediaController->akunjenis()]);
    }

    public function buattugas(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'name' => 'required',
        ]);
        $Tugas = new Tugas();
        $Tugas->name = $request->name;
        $Tugas->deskripsi = $request->deskripsi;
        $Tugas->aktif = $request->aktif;
        $Tugas->id_kelas = $request->id_kelas;

	    $Tugas->id_mata_pelajaran = $request->id_mata_pelajaran;

	    if($request->hasFile('file'))
	    	$Tugas->file = $request->file->getClientOriginalName();

	    $Tugas->owner = Auth::id();

        $Tugas->save();

        @$MC->store('tugas/'.$Tugas->id.'/');
        return Redirect::back()->with('success','Berhasil menambah tugas '.$Tugas->name);
    }

    public function kumpultugas($id,Request $request){
		$MC = new MediaController();

		if(@$MC->akunjenis()!="user")
			return redirect('/');
		$User = User::find(Auth::id());
		$Tugas = Tugas::where("id",$id)->where("aktif",1)->first();
		if(!$Tugas)
			return 0;
		$KumpulTugas = KumpulTugas::where("id_tugas",$Tugas->id)->where("id_user",$User->id)->first();
		if(!$KumpulTugas){
	        $KumpulTugas = new KumpulTugas();
	        $KumpulTugas->id_tugas = $Tugas->id;
	        $KumpulTugas->id_user = $User->id;
		}
		else{
			if($request->hasFile('file'))
				@$MC->delete('kumpultugas/'.$KumpulTugas->id.'/'.
				$KumpulTugas->file);
		}
	    if($request->hasFile('file')){
	    	$KumpulTugas->file = $request->file->getClientOriginalName();
	    }
        $KumpulTugas->deskripsi = $request->deskripsi;
        $KumpulTugas->save();

        @$MC->store('kumpultugas/'.$KumpulTugas->id.'/');
        return Redirect::back()->with('success','Berhasil menambah tugas '.$Tugas->name);
    }

    public function edittugas(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $Tugas = Tugas::find($request->id);
        if(!$Tugas)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Tugas->owner){
        	return redirect('/');
        }
		$Tugas->name = $request->name;
        $Tugas->deskripsi = $request->deskripsi;
        $Tugas->aktif = $request->aktif;
        $Tugas->id_kelas = $request->id_kelas;

	    $Tugas->id_mata_pelajaran = $request->id_mata_pelajaran;

	    if($request->hasFile('file')){
	    	@$MC->delete('tugas/'.$Tugas->id.'/'.
			$Tugas->file);
	    	$Tugas->file = $request->file->getClientOriginalName();        
	    }
	    $Tugas->save();
        @$MC->store('tugas/'.$Tugas->id.'/');
        return Redirect::back()->with('success','Berhasil edit tugas '.$Tugas->name);
    }

    public function hapustugas(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $Tugas = Tugas::find($request->id);
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Tugas->owner){
        	return redirect('/');
        }

		@$MC->delete('tugas/'.$Tugas->id.'/'.
			$Tugas->file);

		$KumpulTugas = KumpulTugas::where("id_tugas",$Tugas->id)->get();
		foreach ($KumpulTugas as $k) {
			@$MC->delete('kumpultugas/'.$k->id.'/'.
				$k->file);
			$k->delete();
		}

        $Tugas->delete();

        return Redirect::back()->with('success','Berhasil hapus tugas');
    }
}
