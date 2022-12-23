<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StokBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stok = StokBarang::all();
        $lastUpdate = StokBarang::get()->first();
        $lastUpdate = Carbon::parse($lastUpdate['updated_at'])->locale('id')->isoFormat('LLLL');
        $data = [
            'stok' => $stok,
            'last' => $lastUpdate
        ];
        if (Auth::user()->role == "admin") {
            return view('pages.dashboard_admin_stok', $data);
        } else {
            return view('pages.dashboard_user_stok', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard_admin_stok_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StokBarang::create([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString(),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
        ]);
        return redirect('/admin/stok')->with(['msg' => 'Data Sukses Diupdate!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function show(StokBarang $stokBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(StokBarang $stokBarang, $id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        return view('pages.dashboard_admin_stok_edit', ['item' => $stokBarang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role == "admin") {
            StokBarang::where('id', '=', $id)->update([
                'nama_barang' => $request->nama_barang,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'user_id' => Auth::user()->id,
                'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()
            ]);
            return redirect('/admin/stok')->with(['msg' => 'Data Sukses Diupdate!']);
        } else {
            $stok = StokBarang::all();
            foreach ($stok as $key => $value) {
                // $jmlstok = $request->stok . "ok";
                $nama = $value['nama_barang'];
                eval("\$nama = \"$nama\";");
                StokBarang::where('nama_barang', $nama)
                    ->update(['stok' => $request->$nama, 'updated_at' => Carbon::now()->timezone('Asia/Jakarta')->toDateTimeLocalString()]);
            }
            return Redirect::back()->withErrors(['msg' => 'Data Sukses Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StokBarang  $stokBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(StokBarang $stokBarang, $id)
    {
        $stokBarang->where('id', '=', $id)->delete();
        return redirect('/admin/stok')->with(['msg' => 'Data Sukses Dihapus!']);
    }
}