<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'kost_id',
        'fasilitas',
    ];

    public function fasilitasjoinkoost()
    {
        $kamar = DB::table('kosts')
            ->join('facilities', 'kosts.id', '=', 'facilities.kost_id',)
            ->select('kosts.namaKost', 'facilities.*')
            ->orderBy('kost_id')
            ->get();
        return $kamar;
    }
}
