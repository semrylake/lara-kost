<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;

class Kost extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'namaKost',
        'namaPemilik',
        'alamat',
        'tlpn',
        'latitude',
        'longitude',
        'foto',
    ];

    public function fasilitas()
    {
        return $this->hasMany(Facility::class);
    }
    public function room()
    {
        return $this->hasMany(Room::class);
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'namaKost'
            ]
        ];
    }
    public function SeachWhereUser()
    {
        $users = DB::table('kosts')
            ->where('user_id', '=',  Auth::user()->id)
            ->get();
        return $users;
    }

    public function updateprofile($slug, $mydata)
    {
        $datakost = Kost::all()->where('slug', $slug)->first();
        // dd($datakost);
        DB::table('kosts')->where('id', $datakost->id)->update($mydata);
    }
    public function jumlah_kost($param)
    {
        $datakost = Kost::all()->where('user_id', $param)->first();
        $jumlahkamar = Room::all()->where('kost_id', $datakost->id)->count();
        return $jumlahkamar;
    }
    public function getDataJoin($param)
    {
        $kost = DB::table('kosts')
            ->where('kosts.slug', $param)
            ->join('rooms', 'kosts.id', '=', 'rooms.kost_id')
            // ->limit(6)
            ->get()
            // ->groupBy('kost_id')

        ;
        return $kost;
    }
    public function kostjoinuser()
    {
        $kost = DB::table('users')
            ->join('kosts', 'users.id', '=', 'kosts.user_id')
            ->get();
        return $kost;
    }
}
