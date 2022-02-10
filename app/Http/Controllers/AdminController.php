<?php

namespace App\Http\Controllers;

use App\Models\{Room, User, Galeri, Kost, Facility, Regulation, Resident, ImageRoom};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->kost = new Kost();
        $this->kamar = new Room();
        $this->fotokamar = new ImageRoom();
        $this->fasilitas = new Facility();
        $this->galeri = new Galeri();
    }
    public function dashboard()
    {
        $users = User::all()->count();
        $kosts = Kost::all()->count();
        $rooms = Room::all()->count();
        $data = [
            'users' => $users,
            'kosts' => $kosts,
            'rooms' => $rooms,
        ];
        return view('admin.dashboard', [
            "title" => "Dashboard",
        ], $data);
    }
    public function admin_user()
    {
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        $data = [
            'users' => $users,
        ];
        return view('admin.dataUser', [
            "title" => "All Users",
        ], $data);
    }
    public function admin_kost()
    {
        // $kost = $this->kost->kostjoinuser();
        $kost = Kost::all();
        $data = [
            'kost' => $kost,
        ];
        return view('admin.dataKosts', [
            "title" => "All Kosts",
        ], $data);
    }
    public function detail_kost($slug)
    {
        $kost = Kost::all()->where('slug', $slug)->first();
        $galeri = Galeri::all()->where('kost_id', $kost->id);
        $jumlahKamar = Room::all()->where('kost_id', $kost->id)->count();
        $hargaTermurah = Room::all()->where('kost_id', $kost->id)->min('harga');
        $fasilitas = Facility::all()->where('kost_id', $kost->id);
        $peraturan = Regulation::all()->where('kost_id', $kost->id);
        $kamar = Room::all()->where('kost_id', $kost->id);
        $penghuni = Resident::all()->where('kost_id', $kost->id);


        $data = [
            "kost" => $kost,
            "galeri" => $galeri,
            "hargaTermurah" => $hargaTermurah,
            "jumlahKamar" => $jumlahKamar,
            "fasilitas" => $fasilitas,
            "peraturan" => $peraturan,
            "kamar" => $kamar,
            "penghuni" => $penghuni,
        ];
        return view('admin.detail_kost', [
            "title" => "Detail Kost",
        ], $data);
    }
    public function detail_kamar($slug)
    {
        $kamar = Room::all()->where('slug', $slug)->first();
        $kost = Kost::all()->where('id', $kamar->kost_id)->first();
        // dd($kost);
        $images_room = ImageRoom::all()->where('room_id', $kamar->id);
        $data = [
            "kamar" => $kamar,
            "images_room" => $images_room,
            "kost" => $kost,
        ];
        return view('admin.detail_kamar', [
            "title" => "Detail Kamar",
        ], $data);
    }
    public function admin_kamar()
    {
        $kamar = $this->kamar->kamarjoinkoost();
        // $kamar = Room::all();
        // dd($kamar);
        $data = [
            'kamar' => $kamar,
        ];
        return view('admin.dataKamar', [
            "title" => "All Rooms",
        ], $data);
    }
    public function admin_fasilitas()
    {
        $fasilitas = $this->fasilitas->fasilitasjoinkoost();
        // $fasilitas = Room::all();
        // dd($fasilitas);
        $data = [
            'fasilitas' => $fasilitas,
        ];
        return view('admin.dataFasilitas', [
            "title" => "All Facilities",
        ], $data);
    }
    public function admin_galeri_foto_kost()
    {
        $galeri = $this->galeri->galerijoinkoost();
        // $galeri = Room::all();
        // dd($galeri);
        $data = [
            'galeri' => $galeri,
        ];
        return view('admin.galerifotokost', [
            "title" => "All Photo",
        ], $data);
    }
    public function admin_galeri_foto_kamar()
    {
        $galeri = $this->fotokamar->galerijoinkoost();
        // $galeri = Room::all();
        // dd($galeri);
        $data = [
            'galeri' => $galeri,
        ];
        return view('admin.galerifotokamar', [
            "title" => "All Photo",
        ], $data);
    }
    public function destroy_foto_kost($slug)
    {
        $gambar = Galeri::all()->where('id', $slug)->first();
        Storage::delete($gambar->foto);
        Galeri::destroy($slug);
        return redirect('/admin-galeri-foto-kost')->with('del_msg', 'Gambar berhasil dihapus.');
    }
    public function destroy_foto_kamar($room)
    {
        $gambar = ImageRoom::all()->where('id', $room)->first();
        Storage::delete($gambar->foto);
        ImageRoom::destroy($room);
        return redirect('/admin-galeri-foto-kamar')->with('del_msg', 'Gambar berhasil dihapus.');
    }

    public function destroy_kost_admin($slug)
    {
        $datakost = Kost::all()->where('slug', $slug)->first();
        $galeri = Galeri::all()->where('id', $datakost->id)->first();
        foreach ($galeri as $a) {
            Storage::delete($a->foto);
        }
        Storage::delete($datakost->foto);
        DB::table('kosts')->where('id', $datakost->id)->delete();
        return redirect('/admin-kost')->with('del_msg', 'Data berhasil dihapus.');
    }
}
