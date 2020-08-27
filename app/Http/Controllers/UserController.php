<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MateriDownload;
use App\MataPelajaran;
use App\Kelas;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function buka($id){
    	$MediaController = new MediaController();
    	$isi='user/'.$id;
    	if(Storage::exists($isi)){
    	}
    	else {
    		$isi='blank/profil.png';
    	}
    	return @$MediaController->buka($isi);
    }

    public function user(){
		$MC = new MediaController();
		$Pengguna = User::get();
		$view = 'admin.user';
		$User = User::find(Auth::id());
		if($User){
			if($User->jenis=="user"){
				return redirect("/userdetail/".$User->id);
			}
		}
		else return redirect("/");

		foreach ($Pengguna as $md) {
			$md->kelas = "Publik";
			if($md->id_kelas>0){
				$kelas = Kelas::find($md->id_kelas);
				if($kelas)
					$md->kelas = $kelas->name;
			}
			else $md->id_kelas=0;
		}
		
    	return view($view, ["Kelas" => Kelas::get(),"MataPelajaran" => MataPelajaran::get() ,"Pengguna" => $Pengguna]);
    }

    public function userdetail($id){
    	$MediaController = new MediaController();
    	$Pengguna = User::find($id);
    	if(!$Pengguna)
    		return 1;

    	$User = User::find(Auth::id());
    	$md = $Pengguna;
    		$md->kelas = "Publik";
			if($md->id_kelas>0){
				$kelas = Kelas::find($md->id_kelas);
				if($kelas)
					$md->kelas = $kelas->name;
			}
		return view('userdetail', ["User" => $md]);
    }

    public function buatuser(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'name' => 'required',
        ]);
        $Pengguna = new User();
        $Pengguna->name = $request->name;
        $Pengguna->email = $request->email;
        if($request->password!="")
        $Pengguna->password = Hash::make($request->password);
    	else
        $Pengguna->password = Hash::make("12345678");
		$Pengguna->jenis = $request->jenis;
        if($request->jenis!="admin")
        $Pengguna->id_kelas = $request->kelas;
        $Pengguna->save();

        return Redirect::back()->with('success','Berhasil menambah user '.$Pengguna->name);
    }

    public function edituser(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $Pengguna = User::find($request->id);
        if(!$Pengguna)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Pengguna->owner){
        	return redirect('/');
        }
		$Pengguna->name = $request->name;
        $Pengguna->email = $request->email;
        if($request->password!="")
        $Pengguna->password = Hash::make($request->password);
    	else
        $Pengguna->password = Hash::make("12345678");
		$Pengguna->jenis = $request->jenis;
        if($request->jenis!="admin")
        $Pengguna->id_kelas = $request->kelas;
        $Pengguna->save();
        return Redirect::back()->with('success','Berhasil edit user '.$Pengguna->name);
    }

    public function hapususer(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $Pengguna = User::find($request->id);
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Pengguna->owner){
        	return redirect('/');
        }

		@$MC->delete('user/'.$Pengguna->id);

        $Pengguna->delete();

        return Redirect::back()->with('success','Berhasil hapus user');
    }
    public function userupdate(Request $request){
    	$User=User::find(Auth::id());
    	if(!$User)
    		return 0;
    	if($request->has("name") && $request->name!=""){
    		$User->name=$request->name;
    		$User->save();
    	}
    	if(request()->hasFile('file')){
            $path = Storage::putFileAs(
                "user",
                request()->file('file'),
                $User->id
            );
        }
    	return Redirect::back()->with('success','Berhasil mengubah profil');
    }
    public function userpassword(Request $request){
    	$User=User::find(Auth::id());
    	if(!$User)
    		return 0;
    	if($request->has("password") && $request->password!=""){
    		if($request->baru!=$request->password)
    			return Redirect::back()->with('error','Konfirmasi password tidak cocok');
    		$User->password=Hash::make($request->password);
    		$User->save();
    	}
    	return Redirect::back()->with('success','Berhasil mengubah password');
    }
}
