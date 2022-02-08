<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Resident extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'kost_id',
        'room_id',
        'name',
        'slug',
        'tempat_lahir',
        'tgl_lahir',
        'jk',
        'tlpn',
        'foto',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function detailResident($a)
    {
        return DB::table('residents')
            ->where('slug', $a)
            ->first();
    }
    public function jumlah_penghuni_group_by($param)
    {
        $datakost = Kost::all()->where('user_id', $param)->first();
        $jumlahPenghuni = DB::table('residents')
            ->where('kost_id', $datakost->id)
            ->select('jk', DB::raw('count(*) as jumlah'))
            ->groupBy('jk')
            ->get();

        return $jumlahPenghuni;
    }
}
