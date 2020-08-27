<?php

namespace App\Http\Controllers;
 
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;

class MediaController extends Controller
{
	public static function akunjenis()
    {
        if(Auth::user()){
        	$User=User::find(Auth::id());
        	if($User)
        		return $User->jenis;
        }
    	return "no";
    }

    public static function buka($direktori)
    {
        if(Storage::exists($direktori)){
        	if(request()->has('download'))
    	    	return Storage::download($direktori);
        	return Storage::get($direktori);
        }
        else return 0;
    }
    public function create()
    {
        return view('create');
    }

    public static function delete($direktori){
        if(Storage::exists($direktori)){
            return Storage::delete($direktori);
        }
        else return 0;
    }
 
    public static function store($direktori)
    {

        if(request()->hasFile('file')){
            $path = Storage::putFileAs(
                $direktori,
                request()->file('file'),
                request()->file('file')->getClientOriginalName()
            );
        }
 
        return ['result' => 'success'];
    }

    public static function buka2($http){
        $exploded = explode('.', $http);
        $yes = end($exploded);
        if($yes == "mp3" || $yes == "wav" || $yes == "ogg")
            return '<audio style="width:100%" controls src="'.$http.'"></audio><br><br>';
        else if($yes == "mp4")
            return '<video style="width:100%" controls src="'.$http.'"></video><br><br>';
        else if($yes == "jpg" || $yes == "jpeg" || $yes == "gif" || $yes == "png")
            return '<img style="width:100%" src="'.$http.'"><br><br>';
        else return "";


    }
}
