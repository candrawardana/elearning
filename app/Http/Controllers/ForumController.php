<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\MataPelajaran;
use App\Kelas;
use App\User;
use Auth;
use Redirect;
use App\ForumIsi;
use App\ForumRate;

class ForumController extends Controller
{
    //
    public function buka($id,$file){
    	$MediaController = new MediaController();
    	$Forum = Forum::find($id);
    	$ijin = false;
    	if(!$Forum)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Forum->publik!=1)
    			return 2;
    	}
    	else {
    		if($Forum->publik != 1){
    			if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Forum->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Forum->id_kelas > 0){
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
    	return @$MediaController->buka('forum/'.$id.'/'.$file);
    }

    public function isibuka($id,$file){
    	$MediaController = new MediaController();
    	$ForumIsi = ForumIsi::find($id);
    	if(!$ForumIsi)
    		return 0;
    	$Forum = Forum::find($ForumIsi->id_forum);
    	$ijin = false;
    	if(!$Forum)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Forum->publik!=1)
    			return 2;
    	}
    	else {
    		if($Forum->publik != 1){
    			if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Forum->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Forum->id_kelas > 0){
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
    	return @$MediaController->buka('forumisi/'.$id.'/'.$file);
    }

    public function forum(){
		$MC = new MediaController();
		$Forum = Forum::whereNull('id_kelas')->get();
		$Forum = [];
		$ForumPublik = Forum::where("publik",1)->get();
		$ForumKelas = Forum::where("publik",1)->get();	
		$view = 'forum';
		$User = User::find(Auth::id());
		if($User){
			if($User->jenis=="user"){
				$Forum = Forum::whereNull('id_kelas')->get();
				$ForumKelas = Forum::where('id_kelas',$User->id_kelas)->get();
			}
			if($User->jenis=="admin"){
				$view = 'admin.forum';
				$Forum = Forum::get();			
			}
			if($User->jenis=="guru"){
				$view = 'admin.forum';
				$Forum = Forum::where("owner",$User->id)->get();			
			}
		}

		foreach ($Forum as $md) {
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

		foreach ($ForumKelas as $md) {
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

		foreach ($ForumPublik as $md) {
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
    		"Forum" => $Forum,
    		"ForumKelas" => $ForumKelas,
    		"ForumPublik" => $ForumPublik,
    	]);
    }

    public function forumdetail($id){
    	$MediaController = new MediaController();
    	$Forum = Forum::find($id);
    	$ijin = false;
    	if(!$Forum)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Forum->publik!=1)
    			return 2;
    	}
    	else {
    		if($Forum->publik != 1){
    			if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Forum->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Forum->id_kelas > 0){
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
	    	if($Forum->aktif != 1){
	    		if($User->jenis != "admin" && $User->jenis != "guru")
			    	$ijin = false;
		    	if($User->jenis=="guru" && $User->id != $Forum->owner)
		    		$ijin = false;
			}
			if($User->jenis=="guru" && $User->id == $Forum->owner)
		   		$ijin = true;
	    }
    	$md = $Forum;
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
		$ForumIsi = ForumIsi::where("id_forum",$Forum->id)->get();
		foreach ($ForumIsi as $f) {
			$f->reply = null;
			$f->replyusername=null;
			$f->replyuserid=null;
			if($f->id_reply){
				$reply = ForumIsi::find($f->id_reply);
				if($reply){
					$u = User::find($f->id_user);
					if($u){
						$f->replyusername=$u->name;
						$f->replyuserid=$u->id;
					}
					$f->reply = $reply->deskripsi;
				}
				else{
					$f->reply = "Telah Dihapus";
				}
			}
			$f->ownername = "-";
			$f->ownerjenis = "-";
			$f->ownerkelas = "Publik";
			$owner = User::find($f->id_user);
			if($owner){
				$f->ownername = $owner->name;
				$f->ownerjenis = $owner->jenis;
				
				$kk=Kelas::find($owner->id_kelas);
				if($kk)
					$f->ownerkelas = $kk->name;

			}
			$f->upvote = ForumRate::
				where("forum_isi",$f->id)
				->where("jenis",1)
				->where("aktif",1)->count();
			$f->downvote = ForumRate::
				where("forum_isi",$f->id)
				->where("jenis",0)
				->where("aktif",1)->count();
			$f->uservote = 2;
			if(Auth::user()){
				$uservote = ForumRate::
				where("forum_isi",$f->id)
				->where("id_user",Auth::id())
				->where("aktif",1)->first();
				if($uservote){
					if($uservote->jenis==1)
						$f->uservote = 1;
					else
						$f->uservote = 0;
				}
			}
		}
		return view('forumdetail', ["Forum" => $md,
			"ForumIsi" => $ForumIsi,
			"ijin" => $ijin,
			"jenis"=>@$MediaController->akunjenis(),
			"MC"=>$MediaController
		]);
    }

    public function buatforum(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && 
			@$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'name' => 'required',
        ]);
        $Forum = new Forum();
        $Forum->name = $request->name;
        $Forum->deskripsi = $request->deskripsi;
        $Forum->aktif = $request->aktif;
        $Forum->publik = $request->publik;
        if($request->id_kelas>0)
        $Forum->id_kelas = $request->id_kelas;

	    $Forum->id_mata_pelajaran = $request->id_mata_pelajaran;

	    if($request->hasFile('file'))
	    	$Forum->file = $request->file->getClientOriginalName();

	    $Forum->owner = Auth::id();

        $Forum->save();

        @$MC->store('forum/'.$Forum->id.'/');
        return Redirect::back()->with('success','Berhasil menambah forum '.$Forum->name);
    }

    public function isiforum($id,Request $request){
		$MC = new MediaController();

		$User = User::find(Auth::id());
		$Forum = Forum::find($id);
    	$ijin = false;
    	if(!$Forum)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Forum->publik!=1)
    			return 2;
    	}
    	else {
    		if($Forum->publik != 1){
    			if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Forum->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Forum->id_kelas > 0){
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
	    	if($Forum->aktif != 1){
	    		if($User->jenis != "admin" && $User->jenis != "guru")
			    	$ijin = false;
		    	if($User->jenis=="guru" && $User->id != $Forum->owner)
		    		$ijin = false;
			}
			if($User->jenis=="guru" && $User->id == $Forum->owner)
		   		$ijin = true;
	    }
	    if($ijin==false)
	    	return 0;
		$ForumIsi = ForumIsi::where("id_forum",$Forum->id)->where("id_user",$User->id)
			->where("id",$request->id)->first();
		if(!$ForumIsi){
	        $ForumIsi = new ForumIsi();
	        $ForumIsi->id_forum = $Forum->id;
	        $ForumIsi->id_user = $User->id;
		}
		else{
			if($request->hasFile('file'))
				@$MC->delete('forumisi/'.$ForumIsi->id.'/'.
				$ForumIsi->file);
		}
	    if($request->hasFile('file')){
	    	$ForumIsi->file = $request->file->getClientOriginalName();
	    }
        $ForumIsi->deskripsi = $request->deskripsi;
        if($request->id_reply>0){
        	$ForumIsi->id_reply = $request->id_reply;
	    }
        $ForumIsi->save();

        @$MC->store('forumisi/'.$ForumIsi->id.'/');
        return Redirect::back()->with('success','Berhasil membalas di '.$Forum->name);
    }

    public function hapusisiforum($id,Request $request){
		$MC = new MediaController();

		$User = User::find(Auth::id());
		$Forum = Forum::find($id);
    	$ijin = false;
    	if(!$Forum)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Forum->publik!=1)
    			return 2;
    	}
    	else {
    		if($Forum->publik != 1){
    			if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Forum->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    	}
			    }
		    	else{
		    		$ijin = true;
		    	}
	    	}
	    	if($Forum->aktif != 1){
	    		if($User->jenis != "admin" && $User->jenis != "guru")
			    	$ijin = false;
			    if($User->jenis=="guru" && $User->id != $Forum->owner)
		   		$ijin = false;
			}
			if($User->jenis=="guru" && $User->id == $Forum->owner)
		   		$ijin = true;
	    }
	    if($ijin==false)
	    	return Redirect::back()->with('error',"Tidak punya akses");
		$ForumIsi = ForumIsi::where("id_forum",$Forum->id)
			->where("id",$request->id)->first();
		if(!$ForumIsi)
			return 7;
		if($User->jenis != "admin" && $User->jenis != "guru" && $User->id != $ForumIsi->id_user)
			return Redirect::back()->with('error',"Tidak punya akses");
		if($ForumIsi){
			@$MC->delete('forumisi/'.$ForumIsi->id.'/'.
			$ForumIsi->file);
			$ForumIsi->delete();
		}
        return Redirect::back()->with('success','Berhasil hapus di '.$Forum->name);
    }

    public function upvote($id){
    	return @$this->vote($id,1);
    }
    public function downvote($id){
    	return @$this->vote($id,0);
    }

    public static function vote($id,$vote){
		$MC = new MediaController();

		$User = User::find(Auth::id());
		$ForumIsi = ForumIsi::find($id);
		if(!$ForumIsi)
			return 0;
		$Forum = Forum::find($ForumIsi->id_forum);
    	$ijin = false;
    	if(!$Forum)
    		return 1;

    	$User = User::find(Auth::id());
    	if(!$User){
    		if($Forum->publik!=1)
    			return 2;
    	}
    	else {
    		if($Forum->publik != 1){
    			if($Forum->id_kelas > 0){
			    	if($User->jenis == "admin"){
			    		$ijin = true;
			    	}
			    	else if($User->jenis == "guru"){
			    		$ijin = true;
			    	}
			    	else{
			    		if($User->id_kelas != $Forum->id_kelas)
			    			return 3;
			    		else $ijin = true;
			    	}
			    }
		    	else
		    		$ijin = true;
	    	}
	    	else{
	    		if($Forum->id_kelas > 0){
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
	    	if($Forum->aktif != 1){
	    		if($User->jenis != "admin" && $User->jenis != "guru")
			    	$ijin = false;
		    	if($User->jenis=="guru" && $User->id != $Forum->owner)
		    		$ijin = false;
			}
			if($User->jenis=="guru" && $User->id == $Forum->owner)
		   		$ijin = true;
	    }
	    if($ijin==false)
	    	return 0;
		$ForumRate = ForumRate::where("forum_isi",$ForumIsi->id)->where("id_user",$User->id)->first();
		if(!$ForumRate){
	        $ForumRate = new ForumRate();
	        $ForumRate->forum_isi = $ForumIsi->id;
	        $ForumRate->id_user = $User->id;
	        $ForumRate->jenis = $vote;
	        $ForumRate->aktif = 1;
		}
		else{
	        if($ForumRate->jenis != $vote)
		        $ForumRate->jenis = $vote;
		    else{
		    	if($ForumRate->aktif != 1)
		    		$ForumRate->aktif = 1;
		    	else $ForumRate->aktif = 0;
		    }
		}
        $ForumRate->save();

        @$MC->store('forumisi/'.$ForumIsi->id.'/');
        return Redirect::back()->with('success','Berhasil vote di '.$Forum->name);
    }

    public function editforum(Request $request){
  		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
            'name' => 'required',
        ]);
        $Forum = Forum::find($request->id);
        if(!$Forum)
            return Redirect::back();
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Forum->owner){
        	return redirect('/');
        }
		$Forum->name = $request->name;
        $Forum->deskripsi = $request->deskripsi;
        $Forum->aktif = $request->aktif;
        $Forum->publik = $request->publik;
        $Forum->id_kelas = $request->id_kelas;

	    $Forum->id_mata_pelajaran = $request->id_mata_pelajaran;

	    if($request->hasFile('file')){
	    	@$MC->delete('forum/'.$Forum->id.'/'.
			$Forum->file);
	    	$Forum->file = $request->file->getClientOriginalName();        
	    }
	    $Forum->save();
        @$MC->store('forum/'.$Forum->id.'/');
        return Redirect::back()->with('success','Berhasil edit forum '.$Forum->name);
    }

    public function hapusforum(Request $request){
		$MC = new MediaController();
		if(@$MC->akunjenis()!="admin" && @$MC->akunjenis()!="guru")
			return redirect('/');
        $request->validate([
            'id' => 'integer|required',
        ]);

        $Forum = Forum::find($request->id);
        $User = User::find(Auth::id());
        if($User->jenis=="guru" && $User->id != $Forum->owner){
        	return redirect('/');
        }

		@$MC->delete('forum/'.$Forum->id.'/'.
			$Forum->file);

		$ForumIsi = ForumIsi::where("id_forum",$Forum->id)->get();
		foreach ($ForumIsi as $k) {
			@$MC->delete('forumisi/'.$k->id.'/'.
				$k->file);
			ForumRate::where("forum_isi",$k->id)->delete();
			$k->delete();
		}

        $Forum->delete();

        return Redirect::back()->with('success','Berhasil hapus forum');
    }
}
