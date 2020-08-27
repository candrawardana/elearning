<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

Route::get('/logout', 'HomeController@logout');

Route::get('/kelas', 'ElearningController@kelas');
Route::post('/kelas/buat', 'ElearningController@buatkelas');
Route::post('/kelas/edit', 'ElearningController@editkelas');
Route::post('/kelas/hapus', 'ElearningController@hapuskelas');

Route::get('/matapelajaran', 'ElearningController@matapelajaran');
Route::post('/matapelajaran/buat', 'ElearningController@buatmatapelajaran');
Route::post('/matapelajaran/edit', 'ElearningController@editmatapelajaran');
Route::post('/matapelajaran/hapus', 'ElearningController@hapusmatapelajaran');

Route::get('/materi', 'MateriDownloadController@materidownload');
Route::get('/materidownload', 'MateriDownloadController@materidownload');
Route::post('/materidownload/buat', 'MateriDownloadController@buatmateridownload');
Route::post('/materidownload/edit', 'MateriDownloadController@editmateridownload');
Route::post('/materidownload/hapus', 'MateriDownloadController@hapusmateridownload');
Route::get('/materi/{id}', 'MateriDownloadController@materidownloaddetail');
Route::get('/materi/download/{id}/{media}', 'MateriDownloadController@buka');
Route::get('/materidownload/download/{id}/{media}', 'MateriDownloadController@buka');

Route::get('/tugas', 'TugasController@tugas');
Route::post('/tugas/buat', 'TugasController@buattugas');
Route::post('/tugas/edit', 'TugasController@edittugas');
Route::post('/tugas/hapus', 'TugasController@hapustugas');
Route::get('/tugasdetail/{id}', 'TugasController@tugasdetail');
Route::post('/tugasdetail/{id}/kumpul', 'TugasController@kumpultugas');
Route::get('/tugas/download/{id}/{media}', 'TugasController@buka');
Route::get('/kumpultugas/download/{id}/{media}', 'TugasController@kumpulbuka');

Route::get('/akun', 'UserController@user');
Route::get('/akun/download/{id}', 'UserController@buka');
Route::post('/akun/buat', 'UserController@buatuser');
Route::post('/akun/edit', 'UserController@edituser');
Route::post('/akun/hapus', 'UserController@hapususer');
Route::get('/akundetail/{id}', 'UserController@userdetail');
Route::post('/akundetail/{id}/update', 'UserController@userupdate');
Route::post('/akundetail/{id}/password', 'UserController@userpassword');

Route::get('/user', 'UserController@user');
Route::get('/user/download/{id}', 'UserController@buka');
Route::post('/user/buat', 'UserController@buatuser');
Route::post('/user/edit', 'UserController@edituser');
Route::post('/user/hapus', 'UserController@hapususer');
Route::get('/userdetail/{id}', 'UserController@userdetail');
Route::post('/user/update', 'UserController@userupdate');
Route::post('/user/password', 'UserController@userpassword');

Route::get('/forum', 'ForumController@forum');
Route::post('/forum/buat', 'ForumController@buatforum');
Route::post('/forum/edit', 'ForumController@editforum');
Route::post('/forum/hapus', 'ForumController@hapusforum');
Route::get('/forumdetail/{id}', 'ForumController@forumdetail');
Route::post('/forumdetail/{id}/isi', 'ForumController@isiforum');
Route::post('/forumdetail/{id}/hapus', 'ForumController@hapusisiforum');
Route::get('/forum/download/{id}/{media}', 'ForumController@buka');
Route::get('/forumisi/download/{id}/{media}', 'ForumController@isibuka');
Route::get('/forumisi/upvote/{id}', 'ForumController@upvote');
Route::get('/forumisi/downvote/{id}', 'ForumController@downvote');

Route::get('/ujian', 'UjianController@ujian');
Route::post('/ujian/buat', 'UjianController@buatujian');
Route::post('/ujian/edit', 'UjianController@editujian');
Route::post('/ujian/hapus', 'UjianController@hapusujian');
Route::get('/ujiandetail/{id}', 'UjianController@ujiandetail');
Route::get('/ujiandetail/{id}/buka', 'UjianController@bukaujian');
Route::post('/ujiandetail/{id}/selesai', 'UjianController@selesaiujian');

Route::get('/soal/{id}', 'SoalController@soal');
Route::post('/soal/{id}/buat', 'SoalController@buatsoal');
Route::post('/soal/{id}/edit', 'SoalController@editsoal');
Route::post('/soal/{id}/hapus', 'SoalController@hapussoal');
Route::get('/soaldetail/{id}/{file}', 'SoalController@buka');