<?php

namespace App\Http\Controllers;

use App\Models\FotoKamar;
use App\Models\ImageRoom;
use App\Models\Kost;
use App\Models\Room;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'keterangan' => $request->keterangan . "-",
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
            $validateImages['foto'] = $request->file('foto')->store('rooms-image');
        }

        ImageRoom::create($validateImages);
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
            Storage::delete($a->foto);
        }
        DB::table('rooms')->where('slug', $room)->delete();
        return redirect('/room')->with('del_msg', 'Data berhasil dihapus.');
    }
    public function destroyImageRoom(Request $request, $room)
    {
        $gambar = ImageRoom::all()->where('id', $room)->first();
        Storage::delete($gambar->foto);
        ImageRoom::destroy($room);

        // DB::table('image_rooms')->where('id', $room)->delete();
        return redirect()->route('detail', $request->slug)->with('del', 'Gambar berhasil dihapus.');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Room::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
