<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;
    protected $fillable = ['stok', 'nama_barang', 'satuan', 'user_id', 'created_at', 'updated_at'];
}