<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'kost_id',
        'kode_kamar',
        'slug',
        'harga',
        'ukuran',
        'keterangan',
    ];
    public function kost()
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }
    public function roomimage()
    {
        return $this->hasOne(ImageRoom::class);
    }
    public function penghuni()
    {
        return $this->hasMany(Resident::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kode_kamar'
            ]
        ];
    }

    public function getKostUser()
    {
        return DB::table('kosts')
            ->where('user_id', Auth::user()->id)
            ->first();
    }
    public function detail($a)
    {
        return DB::table('rooms')
            ->where('slug', $a)
            ->first();
    }
    public function updateRoom($id, $data)
    {
        DB::table('rooms')->where('id', $id)->update($data);
    }
    public function kamar_termurah()
    {
        $kamartermurah = DB::table('kosts')
            ->join('rooms', 'kosts.id', '=', 'rooms.kost_id',)
            ->limit(6)
            ->get()
            ->groupBy('kost_id');



        return $kamartermurah;
    }
    public function kamarjoinkoost()
    {
        $kamar = DB::table('kosts')
            ->join('rooms', 'kosts.id', '=', 'rooms.kost_id',)
            ->select('kosts.namaKost', 'rooms.*')
            ->orderBy('kost_id')
            ->get();
        return $kamar;
    }
}
