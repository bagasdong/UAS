<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileVerification extends Model
{
    use HasFactory;
    protected $table = 'password_resets_mobile';
    protected $fillable = [
        'mobile', 'token', 'created_at', 'updated_at'
    ];
}