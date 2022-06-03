<?php

namespace App\Http\Controllers;

use App\Models\FotoKamar;
use App\Models\ImageRoom;
use App\Models\Kost;
use App\Models\PesanKamar;
use App\Models\Resident;
use App\Models\Room;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->Room = new Room();
        $this->FotoKamar = new ImageRoom();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kost = Kost::all()->where('user_id', Auth::user()->id)->first();
        if ($kost == null) {
            return redirect('/home');
        }
        $room = Room::all()->where('kost_id', $kost->id);
        // dd($room);
        return view('view_room.index', [
            "title" => "Kamar",
            // "kamar" => $room,
        ])->with(compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kost = $this->Room->getKostUser();

        return view('view_room.add-room', [
            "title" => "Tambah Kamar"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'harga' => 'required|numeric|gt:0',
            'ukuran' => 'required|numeric|gt:0',
        ], [
            'name.required' => 'Kolom ini harus diisi !!',
            'harga.required' => 'Kolom ini harus diisi !!',
            'ukuran.required' => 'Kolom ini harus diisi !!',
            'harga.numeric' => 'Kolom ini harus diisi dengan angka !!',
            'ukuran.numeric' => 'Kolom ini harus diisi dengan angka !!',
            'harga.gt' => 'Kolom ini harus diisi dengan angka lebih dari 0 !!',
            'ukuran.gt' => 'Kolom ini harus diisi dengan angka lebih dari 0 !!',
        ]);
        $kost = $this->Room->getKostUser();
        Room::create([
            'kost_id' => $kost->id,
            'kode_kamar' => $request->name . Auth::user()->id,
            'slug' => $request->slug,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/add-room')->with('psn', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function detail($room)
    {
        $room = $this->Room->detail($room);
        $fotokamar = DB::table('image_rooms')->where('room_id', $room->id)->get();

        $data = [
            'room' => $room,
            'fotoKamar' => $fotokamar,
        ];
        return view('view_room.room-detail', [
            "title" => "Kamar"
        ], $data);
    }
    public function addRoomImg(Request $request)
    {
        $validateImages = $request->validate([
            'room_id' => 'required',
            'foto' => 'required|image|file|max:3024',
        ]);
        if ($request->file('foto')) {
            $file = Request()->foto;
            $fileName = Str::random(20) . '.' . $file->extension();
            $file->move(public_path('foto-kamar-kost'), $fileName);

            // $validateImages['foto'] = $request->file('foto')->store('rooms-image');
        }

        ImageRoom::create([
            'foto' =>  $fileName,
            'room_id' =>  $request->room_id,
        ]);
        return redirect()->route('detail', $request->slug)->with('psn', 'Gambar berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($room)
    {
        $data = [
            'room' => $this->Room->detail($room),
        ];
        return view('view_room.edit-room', [
            "title" => "Edit Kamar"
        ], $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $room)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required|numeric|gt:0',
            'ukuran' => 'required|numeric|gt:0',
        ], [
            'name.required' => 'Kolom ini harus diisi !!',
            'harga.required' => 'Kolom ini harus diisi !!',
            'ukuran.required' => 'Kolom ini harus diisi !!',
            'harga.numeric' => 'Kolom ini harus diisi dengan angka !!',
            'ukuran.numeric' => 'Kolom ini harus diisi dengan angka !!',
            'harga.gt' => 'Kolom ini harus diisi dengan angka lebih dari 0 !!',
            'ukuran.gt' => 'Kolom ini harus diisi dengan angka lebih dari 0 !!',
        ]);
        $dataroom = $this->Room->detail($room);
        $data = [
            'kode_kamar' => $request->name . Auth::user()->id,
            'slug' => $request->slug,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'keterangan' => $request->keterangan . "-",
        ];
        $this->Room->updateRoom($dataroom->id, $data);
        return redirect()->route('edit', $request->slug)->with('upt', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($room)
    {
        $dataroom = $this->Room->detail($room);
        $fotokamar = ImageRoom::all()->where('room_id', $dataroom->id);
        foreach ($fotokamar as $a) {
            // Storage::delete($a->foto);
            File::delete('foto-profil-kost/' . $a->foto);
        }
        DB::table('rooms')->where('slug', $room)->delete();
        return redirect('/room')->with('del_msg', 'Data berhasil dihapus.');
    }
    public function destroyImageRoom(Request $request, $room)
    {
        $gambar = ImageRoom::all()->where('id', $room)->first();
        // dd($gambar);
        File::delete('foto-kamar-kost/' . $gambar->foto);
        ImageRoom::destroy($room);

        // DB::table('image_rooms')->where('id', $room)->delete();
        return redirect()->route('detail', $request->slug)->with('del', 'Gambar berhasil dihapus.');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Room::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }


    public function pesanankamar_index()
    {
        $kost = Kost::all()->where('user_id', Auth::user()->id)->first();
        $pesanan = PesanKamar::where('kost_id', $kost->id)->get();

        return view('view_room.pesanan', [
            "title" => "Pesanan Kamar",
            "pesanan" => $pesanan,
        ]);
    }
    public function destroy_pesanan($slug)
    {
        DB::table('pesan_kamars')->where('id', $slug)->delete();
        return redirect('/pesanan')->with('del_msg', 'Data berhasil dihapus.');
    }
    public function pemesan_jadi_penghuni($slug)
    {
        $datapenghuni = DB::table('pesan_kamars')->where('id', $slug)->first();
        $datakamar = DB::table('rooms')->where('kode_kamar', $datapenghuni->room_id)->first();
        Resident::create([
            'kost_id' => $datapenghuni->kost_id,
            'room_id' =>  $datakamar->id,
            'name' => $datapenghuni->namapemesan,
            'slug' => Str::random(10),
            'jk' => $datapenghuni->jk,
            'tlpn' => $datapenghuni->tlpn,
            'status' => $datapenghuni->status,
        ]);
        $data = [
            'keterangan' => 'Sudah Disewa'
        ];
        DB::table('rooms')->where('id', $datakamar->id)->update($data);
        DB::table('pesan_kamars')->where('id', $slug)->delete();
        return redirect('/pesanan')->with('pindahok', 'Data pemesan berhasil dipindahkan sebagai penghuni.');
    }
}
