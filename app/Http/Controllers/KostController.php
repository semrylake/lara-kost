<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;

use Stevebauman\Location\Facades\Location;
use Adrianorosa\GeoLocation\GeoLocation;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{

    public function __construct()
    {
        $this->Kosts = new Kost();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $kost = $this->Kosts->SeachWhereUser();

        if ($kost == null) {
            $status = "off";
        } else {
            $status = "on";
        }
        return view('profile', [
            "title" => "My Profile",
            "kost" => $kost,
            "status" => $status,
        ]);
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
        $validate = $request->validate([
            'nama' => 'required|max:20|min:3',
            'pemilik' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'required|image|file|max:3024',
        ], [
            'nama.required' => 'Nama kost harus diisi !!',
            'nama.max' => 'Nama kost tidak boleh lebih dari 20 huruf !!',
            'nama.min' => 'Nama kost minimal 3 karakter huruf !!',
            'pemilik.required' => 'Pemilik kost harus diisi !!',
            'alamat.required' => 'Alamat harus diisi !!',
            'telepon.required' => 'Nomor Telepon harus diisi !!',
        ]);
        // $validate['user_id'] = Auth::user()->id;
        // $validate['namaKost'] =  $request->nama;
        // $validate['slug'] =  $request->slug;
        // $validate['namaPemilik'] =  $request->pemilik;
        // $validate['alamat'] =  $request->alamat;
        // $validate['tlpn'] =  $request->tlpn;
        // $validate['latitude'] =  $request->latitude;
        // $validate['longitude'] =  $request->longtitude;
        if ($request->file('foto')) {
            $validate['foto'] = $request->file('foto')->store('foto-profil-kost');
        }
        // Kost::create($validate);
        Kost::create([
            'user_id' => Auth::user()->id,
            'namaKost' => $request->nama,
            'slug' => $request->slug,
            'namaPemilik' => $request->pemilik,
            'alamat' => $request->alamat,
            'tlpn' => $request->telepon,
            'latitude' => $request->latitude,
            'longitude' => $request->longtitude,
            'foto' =>  $validate['foto'],
        ]);
        return redirect('/profile')->with('psn', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function show(Kost $kost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function edit(Kost $kost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        // dd($request->all());
        // dd($slug);
        $request->validate([
            'nama' => 'required|max:20|min:3',
            'pemilik' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'image|file|max:3024',
        ], [
            'nama.required' => 'Nama kost harta harus diisi !!',
            'nama.max' => 'Nama kost tidak boleh lebih dari 20 huruf !!',
            'nama.min' => 'Nama kost minimal 3 karakter huruf !!',
            'pemilik.required' => 'Pemilik kost harus diisi !!',
            'alamat.required' => 'Alamat harus diisi !!',
            'telepon.required' => 'Nomor Telepon harus diisi !!',
        ]);
        $foto = "";
        if ($request->file('foto')) {
            $foto = $request->file('foto')->store('foto-profil-kost');
            Storage::delete($request->fotolama);
        } else {
            $foto = $request->fotolama;
        }

        $mydata = [
            'namaKost' => $request->nama,
            'slug' => $request->slug,
            'namaPemilik' => $request->pemilik,
            'alamat' => $request->alamat,
            'tlpn' => $request->telepon,
            'latitude' => $request->latitude,
            'longitude' => $request->longtitude,
            'foto' =>  $foto,
        ];
        $this->Kosts->updateprofile($slug, $mydata);
        return redirect('/profile')->with('update_msg', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kost $kost)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kost::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
