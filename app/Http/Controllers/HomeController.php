<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->Kosts = new Kost();
        $this->Penghuni = new Resident();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->level == "admin") {
            return redirect('/dashboard-admin');
        }
        $kost = Kost::all()->where('user_id', Auth::user()->id)->count();
        $kostdata = Kost::all()->where('user_id', Auth::user()->id)->first();

        if ($kost == 0) {
            return redirect('/profile');
        }

        $jumlahKamar = $this->Kosts->jumlah_kost(Auth::user()->id);
        // $jumlahPenghuni = $this->Penghuni->jumlah_penghuni_group_by(Auth::user()->id);
        $jumlahPenghuni = Resident::all()->where('kost_id', $kostdata->id);

        // dd($jumlahPenghuni);
        if ($kost == null) {
            $status = "off";
        } else {
            $status = "on";
        }

        return view('dashboard', [
            "title" => "Dashboard",
            "status" => $status,
            "kost" => $kost,
            "jumlahKamar" => $jumlahKamar,
            "jumlahPenghuni" => $jumlahPenghuni,
        ]);
    }
}
