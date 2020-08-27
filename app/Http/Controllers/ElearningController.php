<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use Redirect;
use Auth;
use App\User;
use App\MataPelajaran;

class ElearningController extends Controller
{
	public function kelas(){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return Redirect::back()->with('error','Kamu tidak punya akses');
    	return view('admin.kelas', ["Kelas" => Kelas::get() ]);
    }

    public function buatkelas(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin")
			return Redirect::back()->with('error','Kamu tidak punya akses');
        $request->validate([
            'name' => 'required',
        ]);
        $Kelas = new Kelas();
        $Kelas->name = $request->name;
        $Kelas->save();
        return Redirect::back()->with('success','Berhasil menambah kelas '.$Kelas->name);
    }

    public function editkelas(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin")
			return Redirect::back()->with('error','Kamu tidak punya akses');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $Kelas = Kelas::find($request->id);
        if(!$Kelas)
            return Redirect::back();
        $Kelas->name = $request->name;
        $Kelas->save();
        return Redirect::back()->with('success','Berhasil edit kelas '.$Kelas->name);
    }

    public function hapuskelas(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin")
			return Redirect::back()->with('error','Kamu tidak punya akses');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $Kelas = Kelas::find($request->id)->delete();

        return Redirect::back()->with('success','Berhasil hapus kelas');
    }

    public function matapelajaran(){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
            return Redirect::back()->with('error','Kamu tidak punya akses');
    	return view('admin.matapelajaran', ["MataPelajaran" => MataPelajaran::get() ]);
    }

    public function buatmatapelajaran(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin")
			return Redirect::back()->with('error','Kamu tidak punya akses');
        $request->validate([
            'name' => 'required',
        ]);
        $MataPelajaran = new MataPelajaran();
        $MataPelajaran->name = $request->name;
        $MataPelajaran->save();
        return Redirect::back()->with('success','Berhasil menambah mata pelajaran '.$MataPelajaran->name);
    }

    public function editmatapelajaran(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin")
			return Redirect::back()->with('error','Kamu tidak punya akses');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $MataPelajaran = MataPelajaran::find($request->id);
        if(!$MataPelajaran)
            return Redirect::back();
        $MataPelajaran->name = $request->name;
        $MataPelajaran->save();
        return Redirect::back()->with('success','Berhasil edit mata pelajaran '.$MataPelajaran->name);
    }

    public function hapusmatapelajaran(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin")
			return Redirect::back()->with('error','Kamu tidak punya akses');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $MataPelajaran = MataPelajaran::find($request->id)->delete();

        return Redirect::back()->with('success','Berhasil hapus mata pelajaran');
    }
}
