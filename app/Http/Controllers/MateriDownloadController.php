<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MateriDownload;
use App\MataPelajaran;
use App\Kelas;
use App\User;
use Auth;
use Redirect;

class MateriDownloadController extends Controller
{
    //
    public function buka($id,$file){
    	$MediaController = new MediaController();
    	$MateriDownload = MateriDownload::find($id);
    	if(!$MateriDownload)
    		return 1;

    	$User = User::find(Auth::id());
    	if($MateriDownload->id_kelas > 0){	    	
	    	if(!$User)
	    		return 2;
	    	if($User->jenis == "admin"){
	    	}
	    	else if($User->jenis == "guru"){
	    		if($User->id != $MateriDownload->owner)
	    			return 3;
	    	}
	    	else{
	    		if($User->id_kelas != $MateriDownload->id_kelas)
	    			return 4;
	    	}
    	}
    	if($MateriDownload->aktif != 1){
    		if(!$User)
	    		return 5;
	    	if($User->jenis == "admin"){
	    	}
	    	else if($User->jenis == "guru"){
	    	}
	    	else{
	    		return 6;
	    	}
    	}
    	$MateriDownload->download = $MateriDownload->download+=1;
    	$MateriDownload->save();
    	return @$MediaController->buka('materi/'.$id.'/'.$file);
    }

    public function materidownload(){
		$MC = new MediaController();
		$MateriDownload = MateriDownload::WhereNull('id_kelas')->where('aktif',1)->get();
		$view = 'materidownload';
		$User = User::find(Auth::id());
		if($User){
			if($User->jenis=="user"){
				$MateriDownload = MateriDownload::where('id_kelas',$User->id_kelas)->orWhereNull('id_kelas')->get();
			}
			if($User->jenis=="admin"){
				$view = 'admin.materidownload';
				$MateriDownload = MateriDownload::get();			
			}
			if($User->jenis=="guru"){
				$view = 'admin.materidownload';
				$MateriDownload = MateriDownload::where("owner",$User->id)->get();			
			}
		}

		foreach ($MateriDownload as $md) {
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
		
    	return view($view, ["Kelas" => Kelas::get(),"MataPelajaran" => MataPelajaran::get() ,"MateriDownload" => $MateriDownload]);
    }

    public function materidownloaddetail($id){
    	$MediaController = new MediaController();
    	$MateriDownload = MateriDownload::find($id);
    	if(!$MateriDownload)
    		return 1;

    	$User = User::find(Auth::id());
    	if($MateriDownload->id_kelas > 0){	    	
	    	if(!$User)
	    		return 2;
	    	if($User->jenis == "admin"){
	    	}
	    	else if($User->jenis == "guru"){
	    		if($User->id != $MateriDownload->owner)
	    			return 3;
	    	}
	    	else{
	    		if($User->id_kelas != $MateriDownload->id_kelas)
	    			return 4;
	    	}
    	}
    	if($MateriDownload->aktif != 1){
    		if(!$User)
	    		return 5;
	    	if($User->jenis == "admin"){
	    	}
	    	else if($User->jenis == "guru"){
	    	}
	    	else{
	    		return Redirect::back()->with('error','Materi '.$MateriDownload->name.' tidak aktif');
	    	}
    	}
    	$md = $MateriDownload;
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
		return view('materidownloaddetail', 
			[
				"MateriDownload" => $md,
				"MC" => $MediaController
		]);
    }

    public function buatmateridownload(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'name' => 'required',
        ]);
        $MateriDownload = new MateriDownload();
        $MateriDownload->name = $request->name;
        $MateriDownload->deskripsi = $request->deskripsi;
        $MateriDownload->aktif = $request->aktif;
        if($request->id_kelas>0)
	        $MateriDownload->id_kelas = $request->id_kelas;

	    $MateriDownload->id_mata_pelajaran = $request->id_mata_pelajaran;

	    if($request->hasFile('file'))
	    	$MateriDownload->file = $request->file->getClientOriginalName();

	    $MateriDownload->owner = Auth::id();

        $MateriDownload->save();

        @$MC->store('materi/'.$MateriDownload->id.'/');
        return Redirect::back()->with('success','Berhasil menambah materi '.$MateriDownload->name);
    }

    public function editmateridownload(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $MateriDownload = MateriDownload::find($request->id);
        if(!$MateriDownload)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $MateriDownload->owner){
        	return redirect('/');
        }
		$MateriDownload->name = $request->name;
        $MateriDownload->deskripsi = $request->deskripsi;
        $MateriDownload->aktif = $request->aktif;
        if($request->id_kelas>0)
	        $MateriDownload->id_kelas = $request->id_kelas;

	    $MateriDownload->id_mata_pelajaran = $request->id_mata_pelajaran;

	    if($request->hasFile('file')){
	    	@$MC->delete('materi/'.$MateriDownload->id.'/'.
			$MateriDownload->file);
	    	$MateriDownload->file = $request->file->getClientOriginalName();        
	    }
	    $MateriDownload->save();
        @$MC->store('materi/'.$MateriDownload->id.'/');
        return Redirect::back()->with('success','Berhasil edit materi '.$MateriDownload->name);
    }

    public function hapusmateridownload(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $MateriDownload = MateriDownload::find($request->id);
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $MateriDownload->owner){
        	return redirect('/');
        }

		@$MC->delete('materi/'.$MateriDownload->id.'/'.
			$MateriDownload->file);

        $MateriDownload->delete();

        return Redirect::back()->with('success','Berhasil hapus materi');
    }
}
