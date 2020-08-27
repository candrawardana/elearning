<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soal;
use App\Ujian;
use App\Kelas;
use App\MataPelajaran;
use App\User;
use Redirect;
use Auth;

class SoalController extends Controller
{
	public function buka($id,$file){
    	$MediaController = new MediaController();
    	$Soal = Soal::find($id);
    	if(!$Soal)
    		return 9;
    	$Ujian = Ujian::find($Soal->id_ujian);
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
    	return @$MediaController->buka('soal/'.$id.'/'.$file);
    }

    public function soal($id){
		$MC = new MediaController();
		$Soal = Soal::where('id_ujian',$id)->get();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $Ujian = Ujian::find($id);
        if(!$Ujian)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }
    	return view('admin.soal', [
    		"Soal" => $Soal,
    		"id" => $id,
    	]);
    }

    public function buatsoal($id,Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $Ujian = Ujian::find($id);
        if(!$Ujian)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }
        $Soal = new Soal();
        $Soal->id_ujian = $Ujian->id;
        $Soal->soal = $request->soal;
        $Soal->a = $request->a;
        $Soal->b = $request->b;
        $Soal->c = $request->c;
        $Soal->d = $request->d;
        $Soal->jawaban = $request->jawaban;

		if($request->hasFile('file')){
	    	$Soal->file = $request->file->getClientOriginalName();        
	    }
        $Soal->save();
	    @$MC->store('soal/'.$Soal->id.'/');

        return Redirect::back()->with('success','Berhasil menambah soal '.$Soal->name);
    }
    public function editsoal($id,Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
		$Soal = Soal::find($request->id);
		if(!$Soal)
			return 0;
        $Ujian = Ujian::find($Soal->id_ujian);
        if(!$Ujian)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }
        $Soal->soal = $request->soal;
		$Soal->a = $request->a;
        $Soal->b = $request->b;
        $Soal->c = $request->c;
        $Soal->d = $request->d;
        $Soal->jawaban = $request->jawaban;

		if($request->hasFile('file')){
	    	@$MC->delete('soal/'.$Soal->id.'/'.
			$Soal->file);
	    	$Soal->file = $request->file->getClientOriginalName();        
	    }
	    $Soal->save();
        @$MC->store('soal/'.$Soal->id.'/');

        return Redirect::back()->with('success','Berhasil edit soal '.$Soal->name);
    }

    public function hapussoal($id,Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $Soal = Soal::find($request->id);
		if(!$Soal)
			return 0;
        $Ujian = Ujian::find($Soal->id_ujian);
        if(!$Ujian)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Ujian->owner){
        	return redirect('/');
        }

		$MC->delete('soal/'.$Soal->id.'/'.
		$Soal->file);

        $Soal->delete();

        return Redirect::back()->with('success','Berhasil hapus soal');
    }
}
