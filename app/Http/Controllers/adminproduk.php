<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;
use App\Paket;
use App\Ulasan;
use App\Pengguna;
use Redirect;

class adminproduk extends Controller
{
    //
    public function kategori(){
    	$produksi = new fungsiproduk();
        $q = "";
        if(request()->has('q') and request()->q != "")
            $q = request()->q;
    	return view('admin.kategori', ["Kategori" => @$produksi->kategori(), "q" => $q]);
    }

    public function buatkategori(Request $request){
        $request->validate([
            'nama' => 'required',
        ]);
        $Kategori = new Kategori();
        $Kategori->nama = $request->nama;
        $Kategori->save();
        if($request->hasfile('thumbnail')){
            $fungsi = new fungsiproduk();
            @$fungsi->thumbnailkategori($request->thumbnail, $Kategori->id);
        }
        return Redirect::back()->with('success','Berhasil menambah kategori '.$Kategori->nama);
    }

    public function editkategori(Request $request){
        $request->validate([
            'id' => 'integer|required',
            'nama' => 'required',
        ]);
        $Kategori = Kategori::find($request->id);
        if(!$Kategori)
            return Redirect::back();
        $Kategori->nama = $request->nama;
        $Kategori->save();
        if($request->hasfile('thumbnail')){
            $fungsi = new fungsiproduk();
            @$fungsi->thumbnailkategori($request->thumbnail, $Kategori->id);
        }
        return Redirect::back()->with('success','Berhasil edit kategori '.$Kategori->nama);
    }

    public function hapuskategori(Request $request){
        $request->validate([
            'id' => 'integer|required',
        ]);

        $fungsi = new fungsiproduk();
        $le = @$fungsi->hapuskategori($request->id);

        return Redirect::back()->with('success','Berhasil hapus kategori');
    }

    public function produk($id=0){
    	$produksi=new fungsiproduk();
    	$isi = @$produksi->produk($id);
    	$Kategori = $isi["Kategori"];
    	$Produk = $isi["Produk"];
        $Paket = @$produksi->produk(0,"",0,1)["Produk"];
        $q = "";
        if(request()->has('q') and request()->q != "")
            $q = request()->q;
        $print = false;
        if(request()->has('print'))
            $print = true;
    	return view('admin.produk', compact('Kategori','Produk','q','id','Paket','print'));
    }

    public function paketproduk($kategori_id,$id){
        $produksi=new fungsiproduk();

        $Produk = Produk::find($id);
        if(!$Produk)
            return Redirect::back()->with('error','Tidak ada produk tersebut');
        $prosesProduk = @$produksi->detailproduk($id)["Produk"];
        $Produk->terbeli = $prosesProduk->terbeli;
        $Produk->terjual = $prosesProduk->terjual;
        $Produk->favorit = $prosesProduk->favorit;
        $Produk->stok = $prosesProduk->stok;
        $Produk->thumbnail = $prosesProduk->thumbnail;
        $Produk->harga2 = $prosesProduk->harga2;
        $Produk->kategori = $prosesProduk->kategori;

        $Ulasan = Ulasan::where("produk_id",$id)->paginate(20);
        $fungsipengguna=new fungsipengguna();
        foreach ($Ulasan as $u) {
            $User = Pengguna::find($u->users_id);
            $u->name = "tidak ditemukan";
            if($User)
                $u->name = $User->name;
            $u->userpp = @$fungsipengguna->userpp($u->users_id);
            $u->tampil = "Tidak tampil";
            if($u->status==1)
                $u->tampil = "Tampil";
        }
        $Paket = Paket::where('parent_id',$id)->get();
        foreach($Paket as $pkt){
            $p = Produk::find($pkt->produk_id);
            if($p){
                $proses = @$produksi->detailproduk($p->id)["Produk"];
                $p->terbeli = $proses->terbeli;
                $p->terjual = $proses->terjual;
                $p->deskripsi2 = $p->deskripsi;
                $p->deskripsi = $proses->deskripsi;
                $p->deskripsi = $proses->deskripsi;
                $p->favorit = $proses->favorit;
                $p->stok = $proses->stok;
                $p->thumbnail = $proses->thumbnail;
                $p->harga2 = $proses->harga2;
                $p->kategori = $proses->kategori;
                $pkt->p = $p;
            }
            else{
                $pkt->delete();
            }
        }
        return view('admin.paketproduk', compact('Produk','id','Paket','Ulasan'));
    }

    public function tkpproduk($id,Request $request){
        $request->validate([
            'id' => 'required',
            'stok' => 'integer|required',
            'paket' => 'required',
        ]);

        $Produk1 = Produk::find($request->paket);
        if(!$Produk1) 
            return Redirect::back()->with('error','Paket tidak ditemukan');

        $Produk2 = Produk::find($request->id);
        if(!$Produk1) 
            return Redirect::back()->with('error','Paket tidak ditemukan');

        $Paket = Paket::where("parent_id",$request->paket)->where("produk_id",$request->id)->first();

        $jenis = "edit jumlah";

        if(!$Paket){
            $jenis = "tambahkan";
            $Paket = new Paket();
        }
        $Paket->parent_id = $request->paket;
        $Paket->produk_id = $request->id;
        $Paket->stok = $request->stok;
        if($Paket->stok==0){
            $jenis = "hapus";
            $Paket->delete();
        }
        else {
            $Paket->save();
        }

        return Redirect::back()->with('success','Berhasil '.$jenis.' '.$Produk2->nama.' dipaket '.$Produk1->nama);
    }

    public function buatproduk($id,Request $request){
        $request->validate([
            'nama' => 'required',
            'stok' => 'integer|required',
            'deskripsi' => 'required',
            'harga' => 'integer|required',
        ]);
        $Kategori=Kategori::find($id);
        if($Kategori){
            $Produk = new Produk();
            $Produk->kategori_id = $id;
            $Produk->nama = $request->nama;
            $Produk->deskripsi = $request->deskripsi;
            $Produk->harga = $request->harga;
            $Produk->stok = $request->stok;
            $Produk->paket = $request->paket;
            $Produk->harga_beli = $request->harga_beli;
            $Produk->promo = $request->promo;
            $Produk->hot_sale = $request->hot_sale;
            if($request->has("unit") && $request->unit != "")
                $Produk->unit = $request->unit;
            $Produk->save();
            if($request->hasfile('thumbnail')){
                $fungsi = new fungsiproduk();
                @$fungsi->thumbnailproduk($request->thumbnail, $Produk->id);
            }
        }
        return Redirect::back()->with('success','Berhasil menambah produk '.$Produk->nama);
    }

    public function editproduk(Request $request){
        $request->validate([
            'id' => 'integer|required',
            'nama' => 'required',
            'stok' => 'integer|required',
            'deskripsi' => 'required',
            'harga' => 'integer|required',
        ]);
        $Produk = Produk::find($request->id);
        if(!$Produk)
            return Redirect::back();

        $Produk->nama = $request->nama;
        $Produk->deskripsi = $request->deskripsi;
        $Produk->harga = $request->harga;
        if($request->has("unit")){
            if($request->unit != "")
                $Produk->unit = $request->unit;
            else
                $Produk->unit = null;
        }
        $Produk->stok = $request->stok;
        $Produk->harga_beli = $request->harga_beli;
        $Produk->promo = $request->promo;
        $Produk->hot_sale = $request->hot_sale;
        $Produk->save();
        if($request->hasfile('thumbnail')){
            $fungsi = new fungsiproduk();
            @$fungsi->thumbnailproduk($request->thumbnail, $Produk->id);
        }
        return Redirect::back()->with('success','Berhasil mengedit produk '.$Produk->nama);
    }

    public function hapusproduk(Request $request){
        $request->validate([
            'id' => 'integer|required',
        ]);

        $fungsi = new fungsiproduk();
        @$fungsi->hapusproduk($request->id);

        return Redirect::back()->with('success','Berhasil hapus produk');
    }

    public function hapusulasan($id){
        $Ulasan = Ulasan::find($id);
        if($Ulasan)
            $Ulasan->delete();

        return Redirect::back()->with('success','Berhasil hapus ulasan');
    }

    public function tampilulasan($id){
        $Ulasan = Ulasan::find($id);
        $tampil = "menampilkan";
        if($Ulasan){
            if($Ulasan->status==1){
                $tampil = "menyembunyikan";
                $Ulasan->status = 0;
            }
            else{                
                $Ulasan->status = 1;
            }
            $Ulasan->save();
        }
        return Redirect::back()->with('success','Berhasil '.$tampil.' ulasan');
    }

}
