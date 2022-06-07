<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Resident;
use App\Models\Room;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ResidentController extends Controller
{
    public function __construct()
    {
        $this->Resident = new Resident();
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
        $resident = Resident::all()->where('kost_id', $kost->id);
        $data = [
            "resident" => $resident,
        ];
        return view('view_resident.index', [
            "title" => "Penghuni"
        ], $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kost = Kost::all()->where('user_id', Auth::user()->id)->first();
        $room = $kost->room;
        $resident = Resident::all()->where('kost_id', $kost->id);
        return view('view_resident.add-resident', [
            "title" => "Tambah Penghuni",
            "room" => $room,
            "resident" => $resident
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
        $validate =  $request->validate([
            'name' => 'required',
            'room_id' => 'required',
            'slug' => 'required',
            'jk' => 'required',
            'tlpn' => 'required',
            'tgl_lahir' => 'required|date_format:d/m/Y',
            'tempat_lahir' => 'required',
            'status' => 'required',
            'foto' => 'image|file|max:1024',
        ], [
            'name.required' => 'Kolom ini harus diisi !!',
            'room_id.required' => 'Kolom ini harus diisi !!',
            'jk.required' => 'Kolom ini harus diisi !!',
            'tempat_lahir.required' => 'Kolom ini harus diisi !!',
            'tlpn.required' => 'Kolom ini harus diisi !!',
            'status.required' => 'Kolom ini harus diisi !!',
            'tgl_lahir.date_format' => 'Format tanggal tidak sesuai !!',
        ]);

        $kost = Kost::all()->where('user_id', Auth::user()->id)->first();
        $validate['kost_id'] = $kost->id;

        if ($request->file('foto')) {
            $file = Request()->foto;
            $fileName = Str::random(20)  . '.' . $file->extension();
            $file->move(public_path('foto-penghuni-kost'), $fileName);
            // $validate['foto'] = $request->file('foto')->store('resident-image');
            $validate['foto'] = $fileName;
        }

        Resident::create($validate);
        return redirect('/add-resident')->with('psn', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $resident = $this->Resident->detailResident($slug);
        $kost = Kost::all()->where('user_id', Auth::user()->id)->first();
        $room = $kost->room;
        if (!$resident) {
            return abort('404');
        }
        $data = [
            'resident' => $resident,
            'room' => $room,
        ];
        return view('view_resident.edit-resident', [
            "title" => "Edit Penghuni"
        ], $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'room_id' => 'required',
            'slug' => 'required',
            // 'tgl_lahir' => 'date_format:d/m/Y',
            'foto' => 'image|file|max:1024',
        ]);
        if ($request->tgl_lahir) {
            $request->validate([
                'tgl_lahir' => 'date_format:d/m/Y',
            ]);
        }
        if ($request->file('foto')) {
            $file = Request()->foto;
            $fileName = Str::random(20)  . '.' . $file->extension();
            $file->move(public_path('foto-penghuni-kost'), $fileName);
            // $validate['foto'] = $request->file('foto')->store('resident-image');
            $foto = $fileName;
        } else {
            $foto = $request->fotolama;
        }
        $dataPenghuni = Resident::where('slug', $slug)->first();
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'room_id' => $request->room_id,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'status' => $request->status,
            'tlpn' => $request->tlpn,
            'foto' => $foto,
        ];
        // dd($data);

        $this->Resident->updatePenghuni($dataPenghuni->id, $data);

        return redirect()->route('edit', $request->slug)->with('upt', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy($a)
    {
        $resident = $this->Resident->detailResident($a);
        File::delete('foto-penghuni-kost/' . $resident->foto);
        DB::table('residents')->where('slug', $a)->delete();
        $datakamar = Room::where('id', $resident->room_id)->first();
        // Storage::delete($resident->foto);
        $data = [
            'keterangan' => 'Masih Kosong'
        ];
        DB::table('rooms')->where('id', $datakamar->id)->update($data);
        return redirect('/resident')->with('del_msg', 'Data berhasil dihapus.');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Resident::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
