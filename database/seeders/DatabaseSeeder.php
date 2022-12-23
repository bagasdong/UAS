<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\Presensi;
use App\Models\StokBarang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Cabang::create([
            'alamat' => 'Dusun II, Telukan, Grogol, Sukoharjo Regency, Central Java 57552',
            'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
        ]);
        User::create([
            'firstname' => 'Bagas ',
            'lastname' => 'Wijaya',
            'email' => 'admin@miyago.naknan',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'cabang_id' => 1,
            'email_verified_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
        ]);
        User::factory(10)->create();
        User::create([
            'firstname' => 'Bagas',
            'lastname' => 'Wijaya',
            'email' => 'user@miyago.naknan',
            'mobile' => '6282220542202',
            'password' => Hash::make('12345'),
            'role' => 'user',
            'cabang_id' => 1,
            'email_verified_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeString(),
        ]);
        StokBarang::create([
            'nama_barang' => 'Beras',
            'stok' => 0,
            'satuan' => 'kilogram',
            'user_id' => 1,
        ]);
        StokBarang::create([
            'nama_barang' => 'Mie',
            'stok' => 0,
            'satuan' => 'kilogram',
            'user_id' => 1,
        ]);
        StokBarang::create([
            'nama_barang' => 'Minyak',
            'stok' => 0,
            'satuan' => 'liter',
            'user_id' => 1,
        ]);
        Presensi::factory(20)->create();
    }
}