<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use App\Models\Kost;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;

class RegulationController extends Controller
{
    public function __construct()
    {
        $this->Reg = new Regulation();
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
        $regulation = Regulation::all()->where('kost_id', $kost->id);
        return view(
            'view_regulations.index',
            [
                "title" => "Regulation",
                "reg" => $regulation,
            ]
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Regulation::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
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
            'view_regulations.add-regulation',
            [
                "title" => "Tambah Peraturan",
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
            'jns' => 'required',
        ], [
            'name.required' => 'Kolom ini harus diisi !!',
            'jns.required' => 'Kolom ini harus diisi !!',
        ]);
        Regulation::create([
            'kost_id' => $request->iduser,
            'regulation' => $request->name,
            'jenis' => $request->jns,
            'slug' => $request->slug,
        ]);
        return redirect('/add-regulation')->with('psn', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return \Illuminate\Http\Response
     */
    public function show(Regulation $regulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = [
            'reg' => $this->Reg->detail($slug),
        ];
        return view('view_regulations.edit-regulation', [
            "title" => "Edit Regulation",
        ], $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Regulation  $regulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'jns' => 'required',
        ], [
            'name.required' => 'Kolom ini harus diisi !!',
            'jns.required' => 'Kolom ini harus diisi !!',
        ]);

        $datareg = $this->Reg->getRegulation($slug);

        $data = [
            'regulation' => $request->name,
            'jenis' => $request->jns,
            'slug' => $request->slug,
        ];
        $this->Reg->updateRegulation($datareg->id, $data);
        return redirect('/regulation')->with('psn_update', 'Data berhasil diupdate.');
        // dd($datareg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regulation  $regulation
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        DB::table('regulations')->where('slug', $slug)->delete();
        return redirect('/regulation')->with('del_msg', 'Data berhasil dihapus.');
    }
}
