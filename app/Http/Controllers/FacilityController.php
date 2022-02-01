<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
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
        $facility = Facility::all()->where('kost_id', $kost->id);

        // $data = $kost->fasilitas; //relasi kost dan fasilitas

        return view(
            'view_facility.index',
            [
                "title" => "Fasilitas",
                "fasilitas" => $facility,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idkost = Kost::first()->where('user_id', Auth::user()->id)->first();
        return view(
            'view_facility.add-facility',
            [
                "title" => "Tambah Fasilitas",
                "kost" => $idkost,
            ]
        );
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
        ], [
            'name.required' => 'Kolom ini harus diisi !!',
        ]);
        Facility::create([
            'kost_id' => $request->iduser,
            'fasilitas' => $request->name,
        ]);
        return redirect('/add-facility')->with('psn', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($facility)
    {
        DB::table('facilities')->where('id', $facility)->delete();
        return redirect('/facility')->with('del_msg', 'Data berhasil dihapus.');
    }
}
