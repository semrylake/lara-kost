<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Regulation extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'kost_id',
        'regulation',
        'slug',
        'jenis',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'regulation'
            ]
        ];
    }

    public function detail($slug)
    {
        // $dataKost = Apotek::all()->where('id_user',  Auth::user()->id)->first();
        return DB::table('regulations')
            ->where('slug', $slug)
            ->first();
    }
    public function getRegulation($slug)
    {
        // $dataKost = Apotek::all()->where('id_user',  Auth::user()->id)->first();
        return DB::table('regulations')
            ->where('slug', $slug)
            ->first();
    }
    public function updateRegulation($id, $data)
    {
        DB::table('regulations')->where('id', $id)->update($data);
    }
}
