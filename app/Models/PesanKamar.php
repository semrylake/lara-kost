<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'room_id',
        'namapemesan',
        'emailpemesan',
        'jk',
        'tlpn',
        'pekerjaan',
        'status',
        'jumlah',
    ];
}
