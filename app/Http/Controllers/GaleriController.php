<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\ImageRoom;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
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
        $galerifoto = Galeri::all()->where('kost_id', $kost->id);
        $data = [
            'galerifoto' => $galerifoto,
        ];
        return view('view_galeri.index', [
            "title" => "Galeri",
        ], $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kost = DB::table('kosts')->where('user_id', Auth::user()->id)->first();

        $validate = $request->validate([
            'foto' => 'required|image|file|max:3024',
        ]);
        $validate['kost_id'] = $kost->id;
        if ($request->file('foto')) {
            $validate['foto'] = $request->file('foto')->store('kost-galeri');
        }

        Galeri::create($validate);
        return redirect('/galeri')->with('psn', 'Gambar berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $gambar = Galeri::all()->where('id', $slug)->first();
        Storage::delete($gambar->foto);
        Galeri::destroy($slug);
        return redirect('/galeri')->with('del', 'Gambar berhasil dihapus.');
    }
}
