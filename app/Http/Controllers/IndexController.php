<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Galeri;
use App\Models\ImageRoom;
use App\Models\Kost;
use App\Models\Regulation;
use App\Models\Resident;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->kost = new Kost();
        $this->room = new Room();
    }
    public function index()
    {
        $daftarkost = Kost::latest()->limit(6)->get();

        $data = [
            "daftarkost" => $daftarkost,
        ];
        return view('index', [
            "judul" => "Home",
        ], $data);
    }

    public function detailkost($slug)
    {
        $kost = Kost::all()->where('slug', $slug)->first();
        $galeri = Galeri::all()->where('kost_id', $kost->id);
        $jumlahKamar = Room::all()->where('kost_id', $kost->id)->count();
        $hargaTermurah = Room::all()->where('kost_id', $kost->id)->min('harga');
        $fasilitas = Facility::all()->where('kost_id', $kost->id);
        $peraturan = Regulation::all()->where('kost_id', $kost->id);
        $kamar = Room::all()->where('kost_id', $kost->id);
        $penghuni = Resident::all()->where('kost_id', $kost->id);
        // dd($penghuni);
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
        return view('view_index.detail_kost', [
            "judul" => "Detail Kost",
        ], $data);
    }

    public function detailkamar($slug)
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
        return view('view_index.detail_kamar', [
            "judul" => "Detail Kamar",
        ], $data);
    }
    public function allkosts()
    {
        // $kost = Kost::latest();
        $kost = DB::table('kosts');
        // dd($kost->get());
        if (request('search')) {
            // asli
            $kost
                ->join('facilities', 'kosts.id', '=', 'facilities.kost_id')
                ->select(
                    'kosts.namaKost',
                    'kosts.alamat',
                    'kosts.foto',
                    'kosts.tlpn',
                    'kosts.slug',
                    'facilities.fasilitas',
                )->orderBy('kosts.namaKost')
                ->where('kosts.namaKost', 'like', '%' . request('search') . '%')
                ->orWhere('kosts.alamat', 'like', '%' . request('search') . '%')
                ->orWhere('facilities.fasilitas', 'like', '%' . request('search') . '%');
        }

        return view('all_kosts', [
            "judul" => "Semua Kost",
            "kost" => $kost->get(),
        ]);
    }
    public function allrooms()
    {
        $rooms = DB::table('kosts')
            ->join('rooms', 'kosts.id', '=', 'rooms.kost_id')
            // ->join('image_rooms', 'rooms.id', '=', 'image_rooms.room_id')
            ->select(
                'kosts.namaKost',
                'kosts.alamat',
                'kosts.foto',
                'rooms.harga',
                'rooms.slug',
                'rooms.id',
                'rooms.ukuran'
            )
            // ->distinct('kosts.id', 'rooms.kost_id', 'image_rooms.room_id')
            ->orderBy('kosts.namaKost');
        // dd($rooms->get());
        if (request('search')) {
            // asli
            $rooms->where('kosts.namaKost', 'like', '%' . request('search') . '%')
                ->orWhere('kosts.alamat', 'like', '%' . request('search') . '%')
                ->orWhere('rooms.harga', 'like', '%' . request('search') . '%')
                ->orWhere('rooms.ukuran', 'like', '%' . request('search') . '%');
        }

        return view('all_rooms', [
            "judul" => "Semua Kamar",
            "rooms" => $rooms->get(),
        ]);
    }
}
