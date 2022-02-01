<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Galeri extends Model
{
    use HasFactory;
    protected $fillable = [
        'kost_id',
        'foto',
    ];

    public function galerijoinkoost()
    {
        $data = DB::table('kosts')
            ->join('galeris', 'kosts.id', '=', 'galeris.kost_id',)
            ->select('kosts.namaKost', 'galeris.*')
            ->orderBy('galeris.id', 'asc')
            ->get();
        return $data;
    }
}
