<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'waktu_presensi', 'latitude', 'longitude', 'tgl_presensi', 'bukti_presensi', 'created_at', 'updated_at'
    ];
}