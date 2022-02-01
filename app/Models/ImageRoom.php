<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImageRoom extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'foto',
    ];

    public function kamar()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function galerijoinkoost()
    {
        $data = DB::table('kosts')
            ->join('rooms', 'kosts.id', '=', 'rooms.kost_id')
            ->join('image_rooms', 'rooms.id', '=', 'image_rooms.room_id')
            ->select('kosts.namaKost', 'rooms.*', 'image_rooms.*')
            ->orderBy('image_rooms.id', 'asc')
            ->get();
        return $data;
    }
}
