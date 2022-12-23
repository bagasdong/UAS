<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class KeuanganController extends Controller
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
        $keuangan = Keuangan::all();
        $pendapatan = Keuangan::join('users', 'keuangans.user_id', '=', 'users.id')->select('keuangans.*', 'users.firstname', 'users.lastname')->where('jenis_keuangan', '=', 'Pendapatan')->orderBy('created_at', 'ASC')->get();
        $pengeluaran = Keuangan::join('users', 'keuangans.user_id', '=', 'users.id')->select('keuangans.*', 'users.firstname', 'users.lastname')->where('jenis_keuangan', '=', 'Pengeluaran')->orderBy('created_at', 'ASC')->get();
        $data = [
            'keuangan' => $keuangan,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
        ];
        if (Auth::user()->role == 'admin') {
            return view('pages.dashboard_admin_keuangan', $data);
        } else {
            return view('pages.dashboard_user_keuangan', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->pendapatan)) {
            Keuangan::create([
                'jenis_keuangan' => 'Pendapatan',
                'jumlah' => $request->pendapatan,
                'keterangan' => $request->ket_pendapatan,
                'user_id' => Auth::user()->id
            ]);
        }
        if (isset($request->pengeluaran)) {
            Keuangan::create([
                'jenis_keuangan' => 'Pengeluaran',
                'jumlah' => $request->pengeluaran,
                'keterangan' => $request->ket_pengeluaran,
                'user_id' => Auth::user()->id
            ]);
        }
        return Redirect::back()->withErrors(['msg' => 'Data Sukses Diinput!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keuangan $keuangan)
    {
        //
    }
}